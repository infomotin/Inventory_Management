<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Customer;

class SupplierController extends Controller
{
    //AllSupplier
    public function AllSupplier()
    {
        $suppliers  = Supplier::latest()->get();
        return view('admin.backend.supplier.all_supplier', compact('suppliers'));
    }
    //AddSupplier
    public function AddSupplier()
    {
        return view('admin.backend.supplier.add_supplier');
    }
    //StoreSupplier
    public function StoreSupplier(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        Supplier::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        //notification
        $notification = array(
            'message' => 'Supplier created successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('all.supplier')->with($notification);
    }
    //EditSupplier
    public function EditSupplier($id)
    {
        $supplier = Supplier::find($id);
        return view('admin.backend.supplier.edit_supplier', compact('supplier'));
    }
    //UpdateSupplier
    public function UpdateSupplier(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        Supplier::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $notification = array(
            'message' => 'Supplier updated successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('all.supplier')->with($notification);
    }
    //DeleteSupplier
    public function DeleteSupplier($id)
    {
        Supplier::find($id)->delete();
        
        $notification = array(
            'message' => 'Supplier deleted successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('all.supplier')->with($notification);
    }
    // AllCustomer
    public function AllCustomer()
    {
        $customers = Customer::all();
        return view('admin.backend.customer.all_customer', compact('customers'));
    }
    //AddCustomer
    public function AddCustomer()
    {
        return view('admin.backend.customer.add_customer');
    }
    //StoreCustomer
    public function StoreCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        //notification
        $notification = array(
            'message' => 'Customer created successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('all.customer')->with($notification);
    }

}
