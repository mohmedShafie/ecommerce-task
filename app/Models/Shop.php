<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Shop extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name_ar',
        'name_en',
        'slug',
        'email',
        'password',
        'image',
        'description_ar',
        'description_en',
        'status',
        'company_id',
        'section_id',
        'category_id',
        'brand_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function sections()
    {
        return $this->hasMany(Section::class);
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
