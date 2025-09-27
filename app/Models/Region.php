<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'status'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
