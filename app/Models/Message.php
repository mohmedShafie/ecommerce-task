<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'chat_id',
        'customer_id',
        'shop_id',
        'delivery_man_id',
        'order_id',
        'message',
        'type'
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function deliveryMan()
    {
        return $this->belongsTo(DeliveryMan::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
