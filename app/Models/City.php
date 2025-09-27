<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'status',
        'country_id'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
