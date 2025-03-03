<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Models\Store;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SponsorController extends Controller
{
   public function index(){
    $item = Sponsor::all(); 
    $store = Store::all();
    $data = [
        'datas'=>$item,
        'stores'=>$store
    ];
      return view('sponsor',$data);
   }
    public function create(Request $request){
        $item = new Sponsor;
        $item->name = $request->name;
        $item->address = $request->address;
        $item->store_id = $request->store_id;
        $item->save();
        Alert::success('Success', 'Data has been saved');
        return back();
    }
    public function delete($id){
        $item = Sponsor::find($id);
        $item->delete();
        Alert::success('Success', 'Data has been deleted');
        return back();
    }
    public function update(Request $request){
        $item = Sponsor::find($request->id);
        $item->name = $request->name;
        $item->address = $request->address;
        $item->store_id = $request->store_id;
        $item->save();
        Alert::success('Success', 'Data has been updated');
        return back();
    }
}
