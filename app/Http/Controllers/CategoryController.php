<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
   public function index(){
      $item = Category::all();
      $data = [
         'datas'=>$item
      ];

       
    return view('category.category_view',$data);
   }
   public function create(Request $request){
      $item = new Category;
      $item->name = $request->name;
      $item->description = $request->description;
      $item->save();
      Alert::success('Success', 'Data has been saved');
      return back();
   }
   public function delete($id){
      $item = Category::find($id);
      $item->delete();
      Alert::success('Success', 'Data has been deleted');
      return back();
   }
   public function update(Request $request){
      $item = Category::find($request->id);
      $item->name = $request->name;
      $item->description = $request->description;
      $item->save();
      Alert::success('Success', 'Data has been updated');
      return back();
   }
}
