<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toy extends Model
{
    public function brand(){
        return $this->belongsTo(Brand::class);
    }   
    public function toyCategory(){
        return $this->belongsTo(ToyCategories::class);
    }
    public function categories()
    {
        return $this->belongsToMany(ToyCategories::class, 'toy_helpers', 'toy_id', 'category_id');
    }
}
