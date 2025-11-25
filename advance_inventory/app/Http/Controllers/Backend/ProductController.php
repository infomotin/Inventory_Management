<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //AllCategory
    public function AllCategory()
    {
        $categories = ProductCategory::orderBy('id', 'desc')->get();
        return view('admin.backend.category.all_category', compact('categories'));
    }
    //StoreCategory
    public function StoreCategory(Request $request)
    {
        $category = new ProductCategory();
        $category->category_name = $request->category_name;
        $category->category_slug = Str::slug($request->category_name);
        $category->save();
        //notification
        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('all.category')->with($notification);
    }
    //EditCategory
    public function EditCategory($id)
    {
        $category = ProductCategory::findOrFail($id);
        return response()->json($category);
    }

    //UpdateCategory
    public function UpdateCategory(Request $request)
    {
        $id = $request->cat_id;
        ProductCategory::findOrFail($id)->update([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name),
        ]);
        

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    //DeleteCategory
    public function DeleteCategory($id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->delete();
        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }   

}
