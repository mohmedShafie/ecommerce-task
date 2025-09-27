<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = [
        'customer_id',
        'product_id',
        'shop_id',
        'company_id',
        'brand_id',
        'status',
        'created_at',
        'updated_at'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
