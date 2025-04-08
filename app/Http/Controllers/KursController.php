<?php

namespace App\Http\Controllers;

use App\Models\Kurs;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KursController extends Controller
{
    public function index()
    {
        $item = Kurs::all();
        $data = [
            'datas' => $item,
        ];
        return view('coin.kurs', $data);
    }
    public function create(Request $request)
    {
        $item = new Kurs();
        $item->name = $request->name;
        $item->save();
        Alert::success('Success', 'Data has been Created');
        return back();
    }
    public function delete($id)
    {
        $item = Kurs::find($id);
        $item->delete();
        Alert::success('Success', 'Data has been Deleted');
        return back();
    }
    public function update(Request $request, $id)
    {
        $item = Kurs::find($id);
        $item->name = $request->name;
        $item->save();
        Alert::success('Success', 'Data has been Updated');
        return back();
    }
}
