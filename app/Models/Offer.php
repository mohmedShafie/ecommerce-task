<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'discount',
        'discount_type',
        'discount_price',
        'discount_percentage',
        'code',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
