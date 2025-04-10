<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function coins()
    {
        return $this->belongsToMany(Coin::class, 'coin_country', 'country_id', 'coin_id');
    }
}   