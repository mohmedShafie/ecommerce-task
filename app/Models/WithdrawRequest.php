<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    protected $fillable = [
        'customer_id',
        'amount',
        'payment_method',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
