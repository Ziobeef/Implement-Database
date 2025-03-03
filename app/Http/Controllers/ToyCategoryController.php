<?php

namespace App\Http\Controllers;

use App\Models\ToyCategories;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ToyCategoryController extends Controller
{
    public function index()
    {

        $item = ToyCategories::all();
        $data = [
            'datas' => $item
        ];
        return view('toycategory', $data);
    }
    public function create(Request $request)
    {
        $item = new ToyCategories();
        $item->name = $request->name;   
        $item->save();
        Alert::success('Success', 'Data has been saved');

        return back();
    }
    public function delete($id)
    {
        $item = ToyCategories::find($id);
        $item->delete();
        Alert::success('Success', 'Data has been deleted');
        return back();
    }
    public function update(Request $request)
    {
        $item = ToyCategories::find($request->id);
        $item->name = $request->name;
        $item->save();
        Alert::success('Success', 'Data has been updated');
        return back();
    }
}
