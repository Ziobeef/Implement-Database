<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function sponsors(){
        return $this->hasMany(Sponsor::class);
    }
}
