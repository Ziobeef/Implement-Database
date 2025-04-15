<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Country;
use App\Models\Kurs;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CoinController extends Controller
{
    public function index()
    {
        $item = Coin::orderBy('created_at','desc')->get();
        $kurses = Kurs::all();
        $countries = Country::all();
        $data = [
            'datas' => $item,
            'kurses' => $kurses,
            'countries' => $countries
        ];
        return view('coin.coin', $data);
     
    }
    public function create(Request $request)
    {
        $item = new Coin();
        $item->name = $request->name;
        $item->code = $request->code;
        $item->kurs_id = $request->kurs_id;
        $item->save();
        if ($request->has('countries')) {
            $item->countries()->sync($request->countries);
        }
        Alert::success('Success', 'Data has been Created');
        return back();
    }
    public function delete($id)
    {
        $item = Coin::find($id);
        $item->delete();
        Alert::success('Success', 'Data has been Deleted');
        return back();
    }
    public function update(Request $request, $id)
    {
        $item = Coin::find($id);
        $item->name = $request->name;
        $item->kurs_id = $request->kurs_id;
        $item->save();
        if ($request->has('countries')) {
            $item->countries()->sync($request->countries);
        }
        Alert::success('Success', 'Data has been Updated');
        return back();
    }   
}
