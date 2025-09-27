<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopDelivery extends Model
{
    protected $fillable = [
        'shop_id',
        'country_id',
        'city_id',
        'region_id'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function deliveryMan()
    {
        return $this->belongsTo(DeliveryMan::class);
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
