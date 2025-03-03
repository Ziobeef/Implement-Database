<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    public function index()
    {

        $item = Brand::all();
        $data = [
            'datas' => $item
        ];
        return view('brand', $data);
    }
    public function create(Request $request)
    {
        $item = new Brand;
        $item->name = $request->name;   
        $item->save();
        Alert::success('Success', 'Data has been saved');

        return back();
    }
    public function delete($id)
    {
        $item = Brand::find($id);
        $item->delete();
        Alert::success('Success', 'Data has been deleted');
        return back();
    }
    public function update(Request $request)
    {
        $item = Brand::find($request->id);
        $item->name = $request->name;
        $item->save();
        Alert::success('Success', 'Data has been updated');
        return back();
    }

}
