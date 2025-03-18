<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\BukuGenre;
use App\Models\Genre;
use App\Models\Penerbit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BukuController extends Controller
{
    public function index()
    {

        $item = Buku::all();
        $penerbit = Penerbit::all();
        $genre = Genre::all();
        $data = [
            'datas' => $item,
            'penerbits' => $penerbit,
            'genres' => $genre
        ];
       
        return view('buku.buku', $data);
    }
    public function create(Request $request)
    {
        $item = new Buku();
        $item->judul = $request->judul;
        $item->penerbit_id = $request->penerbit_id;
        $item->save();
        if ($request->has('genres')) {
            foreach ($request->genres as $genreId) {
                $bukugenre = new BukuGenre();
                $bukugenre->buku_id = $item->id;
                $bukugenre->genre_id = $genreId;
                $bukugenre->save();
            }
        }
        Alert::success('Success', 'Data has been Created');
        return back();
    }
    public function delete($id)
    {
        $item = Buku::find($id);
        $item->delete();
        Alert::success('Success', 'Data has been Deleted');
        return back();
    }
    public function update(Request $request, $id)
    {
        $item = Buku::find($id);
        $item->judul = $request->judul;
        $item->penerbit_id = $request->penerbit_id;
        $item->genre = $request->genre;
        $item->save();
        Alert::success('Success', 'Data has been Updated');
        return back();
    }
}
