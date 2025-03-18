<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PenerbitController extends Controller
{
    public function index()
    {
        $penerbit = Penerbit::all();
        $data = [
            'datas' => $penerbit
        ];
        
        return view('buku.penerbit', $data);
    }
    public function create(Request $request)
    {
        $item = new Penerbit();
        $item->name = $request->name;
        $item->save();
        return back();
        Alert::success('Success', 'Data has been Created');
    }
    public function delete($id)
    {
        $item = Penerbit::find($id);
        $item->delete();
        return back();
        Alert::success('Success', 'Data has been Deleted');
    }
    public function update(Request $request,$id)
    {
        $item = Penerbit::find($id);
        $item->name = $request->name;
        $item->save();
        return back();
        Alert::success('Success', 'Data has been Updated');
    }
}
