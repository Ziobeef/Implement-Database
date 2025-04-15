<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurs extends Model
{
    
    protected $table = 'kurs';
    public function coins()
    {
        
        return $this->hasMany(Coin::class);
    }
}
