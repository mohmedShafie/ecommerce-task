<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopDeliveryMan extends Model
{
    protected $fillable = [
        'shop_id',
        'name',
        'phone',
        'image',
        'description',
        'status'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
