<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    protected $table = 'coin';
   public function kurs()
   {
       return $this->belongsTo(Kurs::class);
   }
   public function countries()
   {
       return $this->belongsToMany(Country::class, 'coin_country', 'coin_id', 'country_id');
   }
}
