<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ReturnPurchase;
use App\Models\ReturnPurchaseItem;
use App\Models\Warehouse;
use App\Models\Supplier;
use App\Models\ProductCategory;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Purchase;
use App\Models\PurchaseItem;

class ReturnPurchaseController extends Controller
{
    //AllReturnPurchase
    public function AllReturnPurchase()
    {
        $allData = ReturnPurchase::orderBy('id', 'desc')->get();
        return view('admin.backend.return-purchase.all_return_purchase', compact('allData'));
    }

    //AddReturnPurchase
    public function AddReturnPurchase()
    {
        $warehouses = Warehouse::all();
        $suppliers = Supplier::all();

        return view('admin.backend.return-purchase.add_return_purchase', compact('warehouses', 'suppliers'));
    }

    //StoreReturnPurchase
    public function StoreReturnPurchase(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'status' => 'required',
            'supplier_id' => 'required',
        ]);

        try {

            DB::beginTransaction();

            $grandTotal = 0;

            $purchase = ReturnPurchase::create([
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

                ReturnPurchaseItem::create([
                    'return_purchase_id' => $purchase->id,
                    'product_id' => $productData['id'],
                    'net_unit_cost' => $netUnitCost,
                    'stock' => $product->product_qty + $productData['quantity'],
                    'quantity' => $productData['quantity'],
                    'discount' => $productData['discount'] ?? 0,
                    'subtotal' => $subtotal,
                ]);

                $product->decrement('product_qty', $productData['quantity']);
            }

            $purchase->update(['grand_total' => $grandTotal + $request->shipping - $request->discount]);

            DB::commit();

            $notification = array(
                'message' => 'Return Purchase Stored Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.return.purchase')->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
