<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class DefaultImageHelper
{
    /**
     * Get default image path for different entities
     */
    public static function getDefaultImage($entityType, $imagePath = null)
    {
        // If image path is provided and not null, return it
        if ($imagePath && !empty($imagePath)) {
            return self::getImageUrl($imagePath, $entityType);
        }

        // Return default image based on entity type
        $defaultImages = [

        ];

        $defaultImage = $defaultImages[$entityType] ?? 'defults/defualt.png'; // Fallback to banner default
        return self::getImageUrl($defaultImage, $entityType);
    }

    /**
     * Check if file exists at the given path
     */
    public static function fileExists($path)
    {
        if (empty($path)) {
            return false;
        }

        $fullPath = storage_path($path);
        if (!file_exists($fullPath)) {
            //Log::info("File not found at: " . $fullPath);
            return false;
        }
        return true;
    }

    /**
     * Get image URL with fallback to default
     */
    public static function getImageUrl($imagePath, $entityType)
    {
        // Remove any URL scheme or domain if present
        $imagePath = preg_replace('#^https?://[^/]+#', '', $imagePath);

        if (self::fileExists($imagePath)) {
            return asset($imagePath);
        }

        return self::getDefaultImage($entityType, null);
    }
}
