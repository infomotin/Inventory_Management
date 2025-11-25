<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Str;
use App\Models\Product; 
use App\Models\Supplier;
use App\Models\Brand;
use App\Models\ProductImage;
use App\Models\WareHouse;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



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

    //AllProduct
    public function AllProduct()
    {
        $allData = Product::with(['category', 'supplier', 'brand','images','warehouse'])->orderBy('id', 'desc')->get();
        return view('admin.backend.product.product_list', compact('allData'));
    }

    // /AddProduct
    public function AddProduct()
    {
        $categories = ProductCategory::orderBy('id', 'desc')->get();
        $suppliers = Supplier::orderBy('id', 'desc')->get();
        $brands = Brand::orderBy('id', 'desc')->get();
        $warehouses = WareHouse::orderBy('id', 'desc')->get();
        return view('admin.backend.product.add_product', compact('categories', 'suppliers', 'brands','warehouses'));
    }
    //StoreProduct
    public function StoreProduct(Request $request)
    {
            // $table->id();
            // $table->string('name')->nullable();
            // $table->string('code')->nullable();
            // $table->json('image')->nullable();
            // $table->unsignedBigInteger('category_id')->nullable();
            // $table->unsignedBigInteger('brand_id')->nullable();
            // $table->unsignedBigInteger('warehouse_id')->nullable();
            // $table->unsignedBigInteger('supplier_id')->nullable();
            // $table->decimal('price', 10,2)->nullable();  
            // $table->integer('stock_alert')->default(0);
            // $table->text('note')->nullable();
            // $table->integer('product_qty')->default(0);
            // $table->decimal('discount', 10,2)->default(0.00);
            // $table->string('status')->default('Pending');
            // $table->string('active')->default('1');
        //validation
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:product_categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'brand_id' => 'required|exists:brands,id',
            'warehouse_id' => 'required|exists:ware_houses,id',
            'price' => 'required|numeric|min:0',
        ]);
        DB::beginTransaction();
        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'brand_id' => $request->brand_id,
            'warehouse_id' => $request->warehouse_id,
            'price' => $request->price,
            'stock_alert' => $request->stock_alert,
            'note' => $request->note ?? null,
            'product_qty' => $request->product_qty ?? 0,
            'discount' => $request->discount ?? 0.00,
            'status' => $request->status ?? 'Pending',
            'active' => $request->active ?? '1',
            'code' => $request->code ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        //product id
        $product_id = $product->id;
        //multiple image upload
        if ($request->hasFile('image')) {
            //foreach image
            foreach ($request->file('image') as $image) {
                // Process each image here
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()).'.';
                $image->getClientOriginalExtension();
                $img = $manager->read($image);
                $img->resize(200, 200);
                $img->save('upload/productimg/'.$name_gen.$image->getClientOriginalExtension());
                $save_url = 'upload/productimg/'.$name_gen.$image->getClientOriginalExtension();
                ProductImage::create([
                    'product_id' => $product_id,
                    'image' => $save_url,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
            }

        }

        DB::commit();
       //notification 
       $notification = array(
        'message' => 'Product Inserted Successfully',
        'alert-type' => 'success',
        );
        return redirect()->route('all.product')->with($notification);   

    }
    //EditProduct
    public function EditProduct($id)
    {
        $editData = Product::findOrFail($id);
        $categories = ProductCategory::all();
        $suppliers = Supplier::all();
        $brands = Brand::all();
        $warehouses = WareHouse::all();
        $multiimage = ProductImage::where('product_id', $id)->get();
        
        return view('admin.backend.product.edit_product', compact('editData', 'categories', 'suppliers', 'brands', 'warehouses', 'multiimage'));
    }
    //UpdateProduct
    public function UpdateProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50',
            'category_id' => 'required|exists:product_categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'brand_id' => 'required|exists:brands,id',
            'warehouse_id' => 'required|exists:ware_houses,id',
            'price' => 'required|numeric|min:0',
            'stock_alert' => 'required|integer|min:0',
            'note' => 'nullable|string|max:1000',
        ]);

        $product = Product::findOrFail($request->id);
        
        $product->update([
            'name' => $request->name,
            'code' => $request->code,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'brand_id' => $request->brand_id,
            'warehouse_id' => $request->warehouse_id,
            'price' => $request->price,
            'stock_alert' => $request->stock_alert,
            'note' => $request->note ?? null,
            'updated_at' => now(),
        ]);

        // Handle multiple image upload
        if ($request->hasFile('image')) {
            // Delete existing images
            ProductImage::where('product_id', $product->id)->delete();
            //remove existing images

            if ($product->images) {
                foreach ($product->images as $image) {
                    if (file_exists($image->image)) {
                        unlink($image->image);
                    }
                }
            }

            // Add new images
            foreach ($request->file('image') as $image) {
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()).'.';
                $image->getClientOriginalExtension();
                $img = $manager->read($image);
                $img->resize(200, 200);
                $img->save('upload/productimg/'.$name_gen.$image->getClientOriginalExtension());
                $save_url = 'upload/productimg/'.$name_gen.$image->getClientOriginalExtension();
                
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $save_url,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->route('all.product')->with($notification);
    }

    // /DeleteProduct
    public function DeleteProduct($id)
    {
        //remove existing images
        $product = Product::findOrFail($id);
        $image = ProductImage::where('product_id', $product->id)->get();
        // Delete image files
        foreach ($image as $img) {
            if (file_exists($img->image)) {
                unlink($img->image);
            }
        }
        ProductImage::where('product_id', $product->id)->delete();
        $product->delete();
        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

}
