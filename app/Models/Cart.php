<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'customer_id',
        'product_id',
        'company_id',
        'section_id',
        'category_id',
        'brand_id',
        'offer_id',
        'quantity',
        'price',
        'total',
        'status'
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
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
