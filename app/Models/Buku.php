<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class);
    }
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'buku_genres', 'buku_id', 'genre_id');
    }
}
