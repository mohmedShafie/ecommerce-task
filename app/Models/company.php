<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class company extends Authenticatable
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
        'status'
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
    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
    public function brands()
    {
        return $this->hasMany(Brand::class);
    }
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
