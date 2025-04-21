<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Toy;
use Illuminate\Http\Request;

class LoopController extends Controller
{
    public function index()
    {
        $item = Buku::all();
        $jenre = Genre::all();
        $anjay = Toy::all();
        $gurinjay = Category::all();
        $asik = Country::all();
        $data = [
            'bukus' => $item,
            'genres' => $jenre,
            'toys' => $anjay, 
            'categories' => $gurinjay,
            'countries' => $asik
        ];
        return view('loop', $data);
    }
}
