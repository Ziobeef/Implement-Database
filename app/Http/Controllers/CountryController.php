<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        $data = [
            'datas' => $countries,
        ];
        return view('coin.country', $data);
       
    }
    public function create(Request $request)
    {
        $country = new Country();
        $country->name = $request->name;
        $country->save();

        Alert::success('Success', 'Country has been created');
        return back();
    }
    public function delete($id)
    {
        $country = Country::find($id);
        $country->delete();

        Alert::success('Success', 'Country has been deleted');
        return back();
    }
    public function update(Request $request, $id)
    {
        $country = Country::find($id);
        $country->name = $request->name;
        $country->save();

        Alert::success('Success', 'Country has been updated');
        return back();
    }
}
