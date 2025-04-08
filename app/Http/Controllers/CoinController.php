<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Country;
use App\Models\Kurs;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    public function index()
    {
        $item = Coin::all();
        $kurses = Kurs::all();
        $countries = Country::all();
        $data = [
            'datas' => $item,
            'kurses' => $kurses,
            'countries' => $countries
        ];
        return view('coin.coin', $data);
     
    }
}
