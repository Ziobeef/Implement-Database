<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GenreController extends Controller
{
    public function index()
    {
        $penerbit = Genre::all();
        $data = [
            'datas' => $penerbit
        ];
        
        return view('buku.genre', $data);
    }
    public function create(Request $request)
    {
        $item = new Genre();
        $item->name = $request->name;
        $item->save();
        return back();
        Alert::success('Success', 'Data has been Created');
    }
    public function delete($id)
    {
        $item = Genre::find($id);
        $item->delete();
        return back();
        Alert::success('Success', 'Data has been Deleted');
    }
    public function update(Request $request,$id)
    {
        $item = Genre::find($id);
        $item->name = $request->name;
        $item->save();
        return back();
        Alert::success('Success', 'Data has been Updated');
    }
}
