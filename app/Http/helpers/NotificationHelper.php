<?php

namespace App\Http\helpers;

use App\Services\PusherService;

class NotificationHelper
{
    protected static $pusherService = null;

    /**
     * Get PusherService instance
     */
    protected static function getPusherService()
    {
        if (self::$pusherService === null) {
            self::$pusherService = app(PusherService::class);
        }
        return self::$pusherService;
    }

    /**
     * Send notification to all admins
     */
    public static function notifyAdmins($title, $message, $data = [], $notificationType = 'system')
    {
        return self::getPusherService()->sendToAdmin($title, $message, $data, $notificationType);
    }

    /**
     * Send notification to specific admin
     */
    public static function notifyAdmin($adminId, $title, $message, $data = [], $notificationType = 'system')
    {
        return self::getPusherService()->sendToSpecificAdmin($adminId, $title, $message, $data, $notificationType);
    }
    /**
     * Send order notification to admin
     */
    public static function notifyOrderToAdmin($order)
    {
        $title = 'New Order Received';
        $message = "Order #{$order->order_number} has been placed";
        $data = [
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'order_type' => $order->order_type,
            'total_price' => $order->total_price,
            'customer_name' => $order->customer->name,
        ];

        return self::notifyAdmins($title, $message, $data, 'order');
    }

    /**
     * Send order status update notification to customer
     */
    public static function notifyOrderStatusToCustomer($order, $status)
    {
        $statusMessages = [
            'confirmed' => 'Your order has been confirmed',
            'in_preparation' => 'Your order is being prepared',
            'ready' => 'Your order is ready for pickup',
            'out_for_delivery' => 'Your order is out for delivery',
            'delivered' => 'Your order has been delivered',
            'cancelled' => 'Your order has been cancelled',
        ];

        $title = 'Order Status Update';
        $message = $statusMessages[$status] ?? 'Your order status has been updated';
        $data = [
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'status' => $status,
        ];

        return self::notifyAdmins($title, $message, $data, 'order_status');
    }

    /**
     * Send complaint notification to admin
     */
    public static function notifyComplaintToAdmin($complaint)
    {
        $title = 'New Complaint Received';
        $message = "Complaint from {$complaint->customer->name} regarding order #{$complaint->order->order_number}";
        $data = [
            'complaint_id' => $complaint->id,
            'order_id' => $complaint->order_id,
            'order_number' => $complaint->order->order_number,
            'complaint_type' => $complaint->complaint_type,
            'customer_name' => $complaint->customer->name,
        ];

        return self::notifyAdmins($title, $message, $data, 'complaint');
    }
}
