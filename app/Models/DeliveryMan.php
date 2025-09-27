<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryMan extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'image',
        'description',
        'status',
        'country_id',
        'city_id',
        'region_id'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
