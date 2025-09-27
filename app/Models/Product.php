<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'slug',
        'description_ar',
        'description_en',
        'status',
        'category_id',
        'brand_id',
        'company_id',
        'section_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function productStocks()
    {
        return $this->hasMany(ProductStock::class);
    }
    public function productVariations()
    {
        return $this->hasMany(ProductVariation::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
