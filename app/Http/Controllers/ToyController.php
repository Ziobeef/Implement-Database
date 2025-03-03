<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Toy;
use App\Models\ToyCategories;
use App\Models\ToyHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ToyController extends Controller
{
    public function index()
    {
        $item = Toy::all();
        $brands = Brand::all();
        $categories = ToyCategories::all();
        $data = [
            'datas' => $item,
            'brands' => $brands,
            'categories' => $categories
        ];
        
        return view('toy', $data);
    }
    public function create(Request $request)
    {

        $item = new Toy();
        $item->name = $request->name;
        $item->gender = $request->gender;
        $item->brand_id = $request->brand_id;
        $item->save();
        if ($request->has('categories')) {
            foreach ($request->categories as $categoryId) {
                $toyhelper = new ToyHelper();
                $toyhelper->toy_id = $item->id;
                $toyhelper->category_id = $categoryId;
                $toyhelper->save();
            }
        }
        return back();
        Alert::success('Success', 'Data has been Created');
    }
    public function delete($id)
    {
        $item = Toy::find($id);
        $item->delete();
        return back();
        Alert::success('Success', 'Data has been Deleted');
    }
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'gender' => 'required|in:girl,boy',
            'brand_id' => ['required', 'string', Rule::exists(Brand::class, 'id')],
            'categories' => 'required|array',
            'categories.*' => ['required', 'string', Rule::exists(ToyCategories::class, 'id')],
        ]);
        if ($validator->fails()) {
            Alert::error('Validation Error', implode('<br>', $validator->errors()->all()));
            return back();
        }
        $item = Toy::find($id);
        $item->name = $request->name;
        $item->gender = $request->gender;
        $item->brand_id = $request->brand_id;
        $item->save();
        $item->categories()->sync($request->categories); 
        Alert::success('Success', 'Data has been Updated');                           
        return back();
    }
}
