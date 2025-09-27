<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'product_id',
        'company_id',
        'offer_id',
        'payment_id',
        'payment_status',
        'delivery_status',
        'status',
        'delivery_type',
        'delivery_man_id',
        'delivery_address',
        'delivery_phone',
        'delivered_at',
        'cancelled_at',
        'accepted_at',
        'rejected_at',
        'processing_at',
        'completed_at',
        'refunded_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function deliveryMan()
    {
        return $this->belongsTo(DeliveryMan::class);
    }
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function logs()
    {
        return $this->hasMany(Log::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
