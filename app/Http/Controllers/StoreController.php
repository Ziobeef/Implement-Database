<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StoreController extends Controller
{
    public function index(){

        $item = Store::all();
        $category = Category::all();
        $data = [
            'datas'=>$item,
            'categories'=>$category
        ];
        return view('store',$data);

    }
    public function create(Request $request){
        $item = new Store;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->category_id = $request->category_id;
        $item->save();
        Alert::success('Success', 'Data has been saved');

        return back();
    }
    public function delete($id){
        $item = Store::find($id);
        $item->delete();
        Alert::success('Success', 'Data has been deleted');
        return back();
    }
    public function update(Request $request){
        $item = Store::find($request->id);
        $item->name = $request->name;
        $item->description = $request->description;
        $item->category_id = $request->category_id;
        $item->save();
        Alert::success('Success', 'Data has been updated');
        return back();
    }
}
