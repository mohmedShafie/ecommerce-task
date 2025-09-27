<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'slug',
        'image',
        'description_ar',
        'description_en',
        'status'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
    public function companies()
    {
        return $this->hasMany(Company::class);
    }
}
