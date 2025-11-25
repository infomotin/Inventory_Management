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
use App\Models\Purchase;
use App\Models\PurchaseItem;


class PurchaseController extends Controller
{
    //AllPurchase

    public function AllPurchase()
    {
        $allData = Purchase::with('warehouse', 'supplier', 'purchaseItems', 'product')->latest()->get();
        return view('admin.backend.purchase.all_purchase', compact('allData'));
    }
    //AddPurchase

    public function AddPurchase()
    {
        $suppliers = Supplier::all();
        $warehouses = WareHouse::all();
        $brands = Brand::all();

        return view('admin.backend.purchase.add_purchase', compact('suppliers', 'warehouses', 'brands'));
    }

    //PurchaseProductSearch
    public function PurchaseProductSearch(Request $request)
    {
        //    $query = $request->input('query');
        //    $warehouse_id = $request->input('warehouse_id');

        //    $products = Product::where(function($q) use ($query) {
        //        $q->where('name', 'like', '%' . $query . '%')
        //         ->orWhere('code', 'like', '%' . $query . '%');
        //         // ->orWhere('barcode', 'like', '%' . $query . '%');
        //         // ->where('active', '1');
        //    })
        //    ->where('warehouse_id', function($q) use ($warehouse_id) {
        //        $q->where('warehouse_id', $warehouse_id);
        //    })
        //    ->select('id', 'name', 'code', 'price', 'product_qty')
        //    ->limit(5)
        //    ->orderBy('id', 'desc')
        //    ->get();

        //    return response()->json($products);
        $query = $request->input('query');
        $warehouse_id = $request->input('warehouse_id');

        $products = Product::where(function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
                ->orwhere('code', 'like', "%{$query}%");
        })->when($warehouse_id, function ($q) use ($warehouse_id) {
            $q->where('warehouse_id', $warehouse_id);
        })
            ->select('id', 'name', 'code', 'price', 'product_qty')
            ->limit(10)
            ->get();

        return response()->json($products);
    }
    //StorePurchase
    // public function StorePurchase(Request $request)
    // {
    //     $request->validate([
    //         'supplier_id' => 'required',
    //         'warehouse_id' => 'required',
    //     ]);

    //    try{
    //     DB::beginTransaction();
    //     $grandTotal = 0;
    //     $purchase = Purchase::create([
    //         'date' => $request->date,
    //         'warehouse_id' => $request->warehouse_id,
    //         'supplier_id' => $request->supplier_id,
    //         'discount' => $request->discount ?? 0,
    //         'shipping' => $request->shipping ?? 0,
    //         'status' => $request->status,
    //         'note' => $request->note,
    //         'grand_total' => 0, 
    //     ]);
    //     /// Store Purchase Items & Update Stock 
    //     foreach ($request->product_id as $key => $product_id) {
    //         $product = Product::find($product_id);
    //         $product->product_qty = $product->product_qty - $request->quantity[$key];
    //         $product->save();

    //         $grandTotal += $request->price[$key] * $request->quantity[$key];

    //         $purchase->purchaseItems()->create([
    //             'product_id' => $product_id,
    //             'quantity' => $request->quantity[$key],
    //             'price' => $request->price[$key],
    //         ]);
    //     }

    //     $purchase->grand_total = $grandTotal;
    //     $purchase->save();

    //     DB::commit();

    //    }catch(\Exception $e){
    //        DB::rollback();
    //        return response()->json(['error' => $e->getMessage()], 500);
    //    }

    //     return response()->json(['message' => 'Purchase created successfully', 'purchase' => $purchase]);
    // }
    public function StorePurchase(Request $request)
    {

        $request->validate([
            'date' => 'required|date',
            'status' => 'required',
            'supplier_id' => 'required',
        ]);

        try {

            DB::beginTransaction();

            $grandTotal = 0;

            $purchase = Purchase::create([
                'date' => $request->date,
                'warehouse_id' => $request->warehouse_id,
                'supplier_id' => $request->supplier_id,
                'discount' => $request->discount ?? 0,
                'shipping' => $request->shipping ?? 0,
                'status' => $request->status,
                'note' => $request->note,
                'grand_total' => 0,
            ]);

            /// Store Purchase Items & Update Stock 
            foreach ($request->products as $productData) {
                $product = Product::findOrFail($productData['id']);
                $netUnitCost = $productData['net_unit_cost'] ?? $product->price;

                if ($netUnitCost === null) {
                    throw new \Exception("Net Unit cost is missing ofr the product id" . $productData['id']);
                }

                $subtotal = ($netUnitCost * $productData['quantity']) - ($productData['discount'] ?? 0);
                $grandTotal += $subtotal;

                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $productData['id'],
                    'net_unit_cost' => $netUnitCost,
                    'stock' => $product->product_qty + $productData['quantity'],
                    'quantity' => $productData['quantity'],
                    'discount' => $productData['discount'] ?? 0,
                    'subtotal' => $subtotal,
                ]);

                $product->increment('product_qty', $productData['quantity']);
            }

            $purchase->update(['grand_total' => $grandTotal + $request->shipping - $request->discount]);

            DB::commit();

            $notification = array(
                'message' => 'Purchase Stored Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.purchase')->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    // End Method 

    //EditPurchase

    public function EditPurchase($id)
    {
        $editData = Purchase::with('purchaseItems.product')->findOrFail($id);
        $suppliers = Supplier::all();
        $warehouses = WareHouse::all();
        return view('admin.backend.purchase.edit_purchase', compact('editData', 'suppliers', 'warehouses'));
    }
    //UpdatePurchase
    public function UpdatePurchase(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'status' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $purchase = Purchase::findOrFail($id);

            $purchase->update([
                'date' => $request->date,
                'warehouse_id' => $request->warehouse_id,
                'supplier_id' => $request->supplier_id,
                'discount' => $request->discount ?? 0,
                'shipping' => $request->shipping ?? 0,
                'status' => $request->status,
                'note' => $request->note,
                'grand_total' => $request->grand_total,
            ]);

            /// Get Old Purchase Items 
            $oldPurchaseItems = PurchaseItem::where('purchase_id', $purchase->id)->get();

            /// Loop for old purchase items and decrement product qty
            foreach ($oldPurchaseItems as $oldItem) {
                $product = Product::find($oldItem->product_id);
                if ($product) {
                    $product->decrement('product_qty', $oldItem->quantity);
                    // Decrement old quantity 
                }
            }

            /// Delete old Purchase Items 
            PurchaseItem::where('purchase_id', $purchase->id)->delete();

            // loop for new products and insert new purchase items

            foreach ($request->products as $product_id => $productData) {
                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $product_id,
                    'net_unit_cost' => $productData['net_unit_cost'],
                    'stock' => $productData['stock'],
                    'quantity' => $productData['quantity'],
                    'discount' => $productData['discount'] ?? 0,
                    'subtotal' => $productData['subtotal'],
                ]);

                /// Update product stock by incremeting new quantity 
                $product = Product::find($product_id);
                if ($product) {
                    $product->increment('product_qty', $productData['quantity']);
                    // Increment new quantity
                }
            }

            DB::commit();

            $notification = array(
                'message' => 'Purchase Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.purchase')->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    //DetailsPurchase
    public function DetailsPurchase($id)
    {
        $purchase = Purchase::with('purchaseItems.product')->findOrFail($id);
        return view('admin.backend.purchase.purchase_details', compact('purchase'));
    }

    //InvoicePurchase
    public function InvoicePurchase($id)
    {
        $purchase = Purchase::with('purchaseItems.product', 'supplier', 'warehouse')->findOrFail($id);
        return view('admin.backend.purchase.invoice_pdf', compact('purchase'));
    }

    //DeletePurchase
    public function DeletePurchase($id)
    {
        try {
            DB::beginTransaction();
            $purchase = Purchase::findOrFail($id);
            $purchaseItems = PurchaseItem::where('purchase_id', $id)->get();

            foreach ($purchaseItems as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->decrement('product_qty', $item->quantity);
                }
            }
            PurchaseItem::where('purchase_id', $id)->delete();
            $purchase->delete();
            DB::commit();

            $notification = array(
                'message' => 'Purchase Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.purchase')->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    // End Method 
}
