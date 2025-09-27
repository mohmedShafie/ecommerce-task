<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'slug',
        'image',
        'description_ar',
        'description_en',
        'section_id',
        'parent_id',
        'point',
        'status'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function companies()
    {
        return $this->hasMany(Company::class);
    }
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
