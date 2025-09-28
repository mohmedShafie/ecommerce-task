<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Admin;
use Pusher\Pusher;
use Illuminate\Support\Facades\Log;

class PusherService
{
    protected $pusher;

    public function __construct()
    {
        $this->pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            config('broadcasting.connections.pusher.options')
        );
    }

    /**
     * Send notification to admin
     */
    public function sendToAdmin($title, $message, $data = [], $notificationType = 'system')
    {
        try {
            // Get all active admins
            $admins = Admin::get();

            foreach ($admins as $admin) {
                // Create notification in database first
                $notification = Notification::create([
                    'notification_type' => $notificationType,
                    'title' => $title,
                    'message' => $message,
                    'recipient_type' => 'agency',
                    'recipient_id' => $admin->id,
                    'data' => $data,
                    'channel' => 'pusher',
                    'is_sent' => false,
                ]);

                // Push to Pusher after database creation
                $this->pusher->trigger(
                    'agency-channel-' . $admin->id,
                    'agency-notification',
                    [
                        'id' => $notification->id,
                        'title' => $title,
                        'message' => $message,
                        'data' => $data,
                        'notification_type' => $notificationType,
                        'created_at' => $notification->created_at->toISOString(),
                        'is_read' => false,
                    ]
                );

                // Mark as sent
                $notification->markAsSent();
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Send notification to specific admin
     */
    public function sendToSpecificAdmin($adminId, $title, $message, $data = [], $notificationType = 'system')
    {
        try {
            $admin = Admin::find($adminId);
            if (!$admin) {
                Log::error('Admin not found for notification', ['admin_id' => $adminId]);
                return false;
            }

            // Create notification in database first
            $notification = Notification::create([
                'notification_type' => $notificationType,
                'title' => $title,
                'message' => $message,
                'recipient_type' => 'agency',
                'recipient_id' => $admin->id,
                'data' => $data,
                'channel' => 'pusher',
                'is_sent' => false,
            ]);

            // Push to Pusher after database creation
            $this->pusher->trigger(
                'agency-channel-' . $admin->id,
                'agency-notification',
                [
                    'id' => $notification->id,
                    'title' => $title,
                    'message' => $message,
                    'data' => $data,
                    'notification_type' => $notificationType,
                    'created_at' => $notification->created_at->toISOString(),
                    'is_read' => false,
                ]
            );

            // Mark as sent
            $notification->markAsSent();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    /**
     * Get unread notifications for a recipient
     */
    public function getUnreadNotifications($recipientType, $recipientId)
    {
        return Notification::where('recipient_type', $recipientType)
            ->where('recipient_id', $recipientId)
            ->unread()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);
        if ($notification) {
            $notification->markAsRead();
            return true;
        }
        return false;
    }
}
