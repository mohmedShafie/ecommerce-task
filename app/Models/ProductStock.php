<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'discount',
        'discount_type',
        'discount_price',
        'discount_percentage',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
