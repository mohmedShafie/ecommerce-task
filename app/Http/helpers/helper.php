<?php

namespace App\Http\helpers;

class helper
{
    public static function handelOtp($number)
    {
        // Handle NULL or empty values
        if (empty($number) || $number === 'NULL') {
            throw new \Exception('Invalid phone number format');
        }

        // Convert to string and trim
        $number = trim((string)$number);

        // Skip obviously invalid formats
        if (
            strlen($number) < 4 || strlen($number) > 20 || // Too short or too long
            strpos($number, '@') !== false || // Email addresses
            strpos($number, '.com') !== false || // Email domains
            preg_match('/[a-zA-Z]{2,}/', $number) || // Contains multiple letters
            strpos($number, 'شارع') !== false // Arabic text
        ) {
            throw new \Exception('Invalid phone number format');
        }

        // Skip non-Egyptian country codes
        if (
            str_starts_with($number, '+966') || // Saudi Arabia
            str_starts_with($number, '+1') ||   // US/Canada
            str_starts_with($number, '+7') ||   // Russia
            str_starts_with($number, '+21') ||  // Other countries
            str_starts_with($number, '🇸🇩')     // Country flags
        ) {
            throw new \Exception('Invalid phone number format');
        }

        // Clean formatting characters and Unicode
        $number = preg_replace('/[\s\-\.\,\(\)⁩⁦‏‪‬_]/', '', $number);

        // Convert Arabic digits to English
        $arabicDigits = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $number = str_replace($arabicDigits, $englishDigits, $number);

        // Handle multiple numbers separated by dots, commas, or dashes
        if (preg_match('/[\.\,\-]/', $number)) {
            // Split and take the first valid-looking number
            $parts = preg_split('/[\.\,\-]/', $number);
            foreach ($parts as $part) {
                $part = trim($part);
                if (strlen($part) >= 7 && strlen($part) <= 11 && ctype_digit($part)) {
                    $number = $part;
                    break;
                }
            }
        }

        // Remove any remaining non-digit characters except +
        $number = preg_replace('/[^\d\+]/', '', $number);

        // Check if it's already a valid Egyptian mobile number (9 digits starting with 1)
        if (preg_match('/^1[0-9]{8}$/', $number)) {
            return $number; // Already valid, return as is
        }

        // Remove common prefixes
        if (str_starts_with($number, '+20')) {
            $cleaned = substr($number, 3);
        } elseif (str_starts_with($number, '0020')) {
            $cleaned = substr($number, 4);
        } elseif (str_starts_with($number, '20') && strlen($number) > 10) {
            $cleaned = substr($number, 2);
        } elseif (str_starts_with($number, '02') || str_starts_with($number, '01')) {
            $cleaned = ltrim($number, '0');
        } elseif (str_starts_with($number, '+20+')) {
            $cleaned = substr($number, 4);
        } elseif (str_starts_with($number, '0') && strlen($number) > 8) {
            $cleaned = substr($number, 1);
        } else {
            $cleaned = $number;
        }

        // Final validation - must be digits only and reasonable length
        if (!ctype_digit($cleaned)) {
            throw new \Exception('Invalid phone number format');
        }

        // Check for valid Egyptian mobile patterns
        if (preg_match('/^1[0-9]{8}$/', $cleaned)) { // 1xxxxxxxx (9 digits)
            return $cleaned;
        } elseif (preg_match('/^[0-9]{7,8}$/', $cleaned)) { // 7-8 digits (landline)
            return $cleaned;
        } elseif (strlen($cleaned) < 6 || strlen($cleaned) > 12) { // Too short or too long
            throw new \Exception('Invalid phone number format');
        } elseif (preg_match('/^0+$/', $cleaned) || preg_match('/^1+$/', $cleaned) || preg_match('/^(\d)\1+$/', $cleaned)) { // All same digit
            throw new \Exception('Invalid phone number format');
        }

        // If we get here, it might be a valid number but not standard format
        return $cleaned;
    }
}