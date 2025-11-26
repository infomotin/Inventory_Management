<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    //AllBrand
    public function AllBrand(){
        if(!auth()->user()->hasPermissionTo('all.brand')){
            abort(403,'You do not have permission to view brands.');
        }
        $brand = Brand::all();
        return view('admin.backend.brand.all_brand',compact('brand'));
    }
    //AddBrand
    public function AddBrand(){
        return view('admin.backend.brand.add_brand');
    }
    //StoreBrand
    public function StoreBrand(Request $request){
        $request->validate([
            'name' => 'required|unique:brands',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/brand'), $imageName);
            $brand->image = 'upload/brand/' . $imageName;
        }

        $brand->save();

        return redirect()->route('all.brand')->with('success', 'Brand created successfully.');
    }
    
    //EditBrand
    public function EditBrand($id){
        $brand = Brand::find($id);
        return view('admin.backend.brand.edit_brand', compact('brand'));
    }
    
    //UpdateBrand
    public function UpdateBrand(Request $request){
        $id = $request->id;
        $request->validate([
            'name' => 'required|unique:brands,name,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $brand = Brand::find($id);
        $brand->name = $request->name;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/brand'), $imageName);
            $brand->image = 'upload/brand/' . $imageName;
        }

        $brand->save();

        return redirect()->route('all.brand')->with('success', 'Brand updated successfully.');
    }
    
    //DeleteBrand
    public function DeleteBrand($id){
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->route('all.brand')->with('success', 'Brand deleted successfully.');
    }   
}
