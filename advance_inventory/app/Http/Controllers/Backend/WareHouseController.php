<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\WareHouse;

class WareHouseController extends Controller
{
    //AllWarehouse
    public function AllWarehouse(){
        $warehouses = WareHouse::orderBy('id', 'desc')->get();
        return view('admin.backend.warehouse.all_warehouse', compact('warehouses'));
    }
    //AddWarehouse
    public function AddWarehouse(){
        return view('admin.backend.warehouse.add_warehouse');
    }
    //StoreWarehouse
    public function StoreWarehouse(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
        ]);

        WareHouse::create($request->all());
        //notification
        $notification = array(
            'message' => 'Warehouse created successfully.',
            'alert-type' => 'success',
        );
        return redirect()->route('all.warehouse')->with($notification);
    }
    //EditWarehouse
    public function EditWarehouse($id){
        $warehouse = WareHouse::find($id);
        return view('admin.backend.warehouse.edit_warehouse', compact('warehouse'));
    }
    //UpdateWarehouse
    public function UpdateWarehouse(Request $request){
        $id = $request->id;
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
        ]);
        
        WareHouse::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
        ]);
        
        //notification
        $notification = array(
            'message' => 'Warehouse updated successfully.',
            'alert-type' => 'success',
        );
        return redirect()->route('all.warehouse')->with($notification);
    }
    //DeleteWarehouse
    public function DeleteWarehouse($id){
        WareHouse::find($id)->delete();
        //notification
        $notification = array(
            'message' => 'Warehouse deleted successfully.',
            'alert-type' => 'success',
        );
        return redirect()->route('all.warehouse')->with($notification);
    }
    
    
    //GetWarehouse
    public function GetWarehouse($id){
        $warehouse = WareHouse::find($id);
        return response()->json($warehouse);
    }
    
    //GetWarehouseApi
    public function GetWarehouseApi($id){
        $warehouse = WareHouse::find($id);
        return response()->json($warehouse);
    }
    
    //GetAllWarehousesApi
    public function GetAllWarehousesApi(){
        $warehouses = WareHouse::orderBy('id', 'desc')->get();
        return response()->json($warehouses);
    }
    
    //GetWarehouseByNameApi
    public function GetWarehouseByNameApi($name){
        $warehouse = WareHouse::where('name', $name)->first();
        return response()->json($warehouse);
    }
    
    //GetWarehouseByEmailApi
    public function GetWarehouseByEmailApi($email){
        $warehouse = WareHouse::where('email', $email)->first();
        return response()->json($warehouse);
    }
    
    //GetWarehouseByPhoneApi
    public function GetWarehouseByPhoneApi($phone){
        $warehouse = WareHouse::where('phone', $phone)->first();
        return response()->json($warehouse);
    }
    
    //GetWarehouseByCityApi
    public function GetWarehouseByCityApi($city){
        $warehouse = WareHouse::where('city', $city)->first();
        return response()->json($warehouse);
    }
}
