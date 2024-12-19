<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\shippingCharge;

class shippingChargeController extends Controller
{
    public function viewShippingCharge(){
        $shippingCharge = shippingCharge::getRecord();
        return view('admin.pages.shippingCharge', compact('shippingCharge'));
    }
    
    public function addshippingcharge(){
        return view('admin.create.shippingCharge');
    }

    public function storeshippingcharge(Request $request){
        $request->validate([
            'name' =>'required|max:255',
        ]);

        $shippingCharge = new shippingCharge();
        $shippingCharge->name = $request->name;
        $shippingCharge->price = $request->price;
        $shippingCharge->status = $request->status;
        $shippingCharge->save();

        $notification = [
            'message' => 'Shipping Charge added successfully!',
            'alert-type' =>'success'
        ];

        return redirect()->route('shipping_charge')->with($notification);
    }


    
    public function updateshippingcharge(Request $request){

        if(empty($request->name)){
            $notification = [
                'message' => 'Name Field is required!',
                 'alert-type' =>'error'
             ];
     
             return redirect()->back()->with($notification);
        }

        $shippingCharge = shippingCharge::find($request->id);
        $shippingCharge->name = $request->name;
        $shippingCharge->price = $request->price;
        $shippingCharge->status = $request->status;
        $shippingCharge->save();

        $notification = [
           'message' => 'Shipping Charge updated successfully!',
            'alert-type' =>'success'
        ];

        return redirect()->back()->with($notification);
    }

    
    public function deleteshippingcharge($id){
        $shippingCharge = shippingCharge::find($id);
        $shippingCharge->isdelete = $shippingCharge->status  = 1;
        $shippingCharge->save();

        $notification = [
           'message' => 'Shipping Charge deleted successfully!',
            'alert-type' =>'success'
        ];

        return redirect()->back()->with($notification);
    }

    



}
