<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopToken extends Model
{
    protected $fillable = [
        'shop_id',
        'token'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
