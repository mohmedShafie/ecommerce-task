<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'payment_method',
        'invoice_number',
        'transaction_id',
        'payment_type',
        'payment_status',
        'payment_amount',
        'payment_currency'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
