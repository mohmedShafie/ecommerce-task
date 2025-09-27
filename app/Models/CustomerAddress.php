<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $fillable = [
        'customer_id',
        'address',
        'latitude',
        'longitude',
        'phone',
        'country_id',
        'city_id',
        'region_id',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
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
}
