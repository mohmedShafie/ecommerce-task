<?php

namespace App\Services;

use App\Models\CustomerToken;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Google\Client as GoogleClient;

class FirebaseNotificationService
{
    protected $projectId;
    protected $serviceAccountPath;
    protected $fcmUrl;

    public function __construct()
    {
        // Set your Firebase project ID from environment
        $this->projectId = env('FIREBASE_PROJECT_ID', 'doctorpharma-3fc44');

        // Path to your service account JSON file (should be a file path, not URL)
        $this->serviceAccountPath = storage_path('app/firebase/' . env('FIREBASE_SERVICE_ACCOUNT_PATH', 'google-services.json'));

        // FCM HTTP v1 API endpoint
        $this->fcmUrl = "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send";

        // Validate configuration
        if (empty($this->projectId)) {
            Log::error('Firebase project ID not configured');
            throw new \Exception('Firebase project ID not configured. Please set FIREBASE_PROJECT_ID in your .env file');
        }

        if (!file_exists($this->serviceAccountPath)) {
            Log::error('Firebase service account file not found at: ' . $this->serviceAccountPath);
            throw new \Exception("Firebase service account file not found at: {$this->serviceAccountPath}. Please ensure the service account JSON file is placed in storage/app/firebase/ directory.");
        }

        // Validate service account file content
        $serviceAccountContent = file_get_contents($this->serviceAccountPath);
        $serviceAccountData = json_decode($serviceAccountContent, true);

        if (!$serviceAccountData || !isset($serviceAccountData['client_id']) || !isset($serviceAccountData['private_key'])) {
            Log::error('Invalid service account file format');
            throw new \Exception('Invalid service account file. Please ensure you downloaded the correct Service Account JSON file from Firebase Console.');
        }
    }

    /**
     * Send notification to customer
     */
    public function sendToCustomer($customer, $title, $message, $additionalData = [])
    {
        try {
            // Get customer's FCM tokens
            $fcmTokens = $customer->fcmTokens()->where('is_active', true)->pluck('fcm_token')->toArray();

            if (empty($fcmTokens)) {
                Log::warning("Customer {$customer->id} does not have active FCM tokens");
                return false;
            }

            $successCount = 0;
            foreach ($fcmTokens as $token) {
                if ($this->sendNotification($token, $title, $message, $additionalData)) {
                    $successCount++;
                }
            }

            return $successCount > 0;
        } catch (\Exception $e) {
            Log::error("Error sending notification to customer {$customer->id}: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Send FCM notification using HTTP v1 API
     */
    protected function sendNotification($fcmToken, $title, $message, $additionalData = [])
    {
        try {
            // Get OAuth 2.0 access token
            $accessToken = $this->getAccessToken();

            if (!$accessToken) {
                Log::error('Failed to get access token for FCM');
                return false;
            }

            // Convert all additional data values to strings (FCM requirement)
            $stringifiedData = [];
            foreach ($additionalData as $key => $value) {
                if (is_array($value) || is_object($value)) {
                    $stringifiedData[$key] = json_encode($value);
                } elseif (is_bool($value)) {
                    $stringifiedData[$key] = $value ? '1' : '0';
                } elseif (is_null($value)) {
                    $stringifiedData[$key] = '';
                } else {
                    $stringifiedData[$key] = (string) $value;
                }
            }

            // Prepare notification payload for HTTP v1 API
            $payload = [
                'message' => [
                    'token' => $fcmToken,
                    'notification' => [
                        'title' => $title,
                        'body' => $message,
                    ],
                    'data' => array_merge($stringifiedData, [
                        'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                    ]),
                    'android' => [
                        'notification' => [
                            'sound' => 'default',
                            'channel_id' => 'default',
                        ]
                    ],
                    'apns' => [
                        'payload' => [
                            'aps' => [
                                'sound' => 'default',
                            ]
                        ]
                    ]
                ]
            ];

            // Send the notification
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->post($this->fcmUrl, $payload);

            if ($response->successful()) {
                $responseData = $response->json();
                Log::info('FCM notification sent successfully', [
                    'token' => substr($fcmToken, 0, 20) . '...',
                    'title' => $title,
                    'message_id' => $responseData['name'] ?? 'unknown'
                ]);
                return true;
            } else {
                $errorData = $response->json();
                Log::error('FCM notification failed', [
                    'status' => $response->status(),
                    'error' => $errorData,
                    'token' => substr($fcmToken, 0, 20) . '...'
                ]);

                // Handle invalid token
                if (
                    isset($errorData['error']['code']) &&
                    (in_array($errorData['error']['code'], [404, 'NOT_FOUND']) ||
                        str_contains($errorData['error']['message'], 'not a valid FCM registration token'))
                ) {
                    $this->handleInvalidToken($fcmToken);
                }

                return false;
            }
        } catch (\Exception $e) {
            Log::error('Error sending FCM notification: ' . $e->getMessage());
            return false;
        }
    }
    /**
     * Get OAuth 2.0 access token using service account
     */
    protected function getAccessToken()
    {
        try {
            $client = new GoogleClient();

            // Set the service account credentials
            $client->setAuthConfig($this->serviceAccountPath);
            $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

            // Get access token
            $accessToken = $client->fetchAccessTokenWithAssertion();

            if (isset($accessToken['error'])) {
                Log::error('Error getting access token: ' . ($accessToken['error_description'] ?? $accessToken['error']));
                return null;
            }

            if (!isset($accessToken['access_token'])) {
                Log::error('No access token received from Google');
                return null;
            }

            return $accessToken['access_token'];
        } catch (\Exception $e) {
            Log::error('Error fetching access token: ' . $e->getMessage());

            // Additional debugging information
            if (file_exists($this->serviceAccountPath)) {
                $content = file_get_contents($this->serviceAccountPath);
                $data = json_decode($content, true);
                if ($data) {
                    Log::info('Service account file structure:', [
                        'has_client_id' => isset($data['client_id']),
                        'has_private_key' => isset($data['private_key']),
                        'has_client_email' => isset($data['client_email']),
                        'project_id' => $data['project_id'] ?? 'missing',
                        'type' => $data['type'] ?? 'missing'
                    ]);
                } else {
                    Log::error('Service account file contains invalid JSON');
                }
            }

            return null;
        }
    }

    /**
     * Handle invalid FCM token by marking it as inactive
     */
    protected function handleInvalidToken($fcmToken)
    {
        try {
            // Find and deactivate the invalid token
            $tokenModels = [
                CustomerToken::class,
            ];

            foreach ($tokenModels as $model) {
                if (class_exists($model)) {
                    $updated = $model::where('fcm_token', $fcmToken)
                        ->update(['is_active' => false]);

                    if ($updated > 0) {
                        Log::info('Marked invalid FCM token as inactive', [
                            'model' => $model,
                            'token' => substr($fcmToken, 0, 20) . '...'
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Error handling invalid token: ' . $e->getMessage());
        }
    }

    /**
     * Send notification to multiple tokens (batch sending)
     */
    public function sendToMultipleTokens($tokens, $title, $message, $additionalData = [])
    {
        $successCount = 0;

        foreach ($tokens as $token) {
            if ($this->sendNotification($token, $title, $message, $additionalData)) {
                $successCount++;
            }
        }

        return $successCount;
    }
}
