<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'status'
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
