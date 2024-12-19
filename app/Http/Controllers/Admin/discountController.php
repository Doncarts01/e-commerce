<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\color;
use App\Models\couponCode;


class discountController extends Controller
{

    public function viewdiscount(){
        $coupon = couponCode::getRecord();
        return view('admin.pages.discountCode', compact('coupon'));
    }
    
    public function adddiscount(){
        return view('admin.create.discountCode');
    }

    public function storediscount(Request $request){
        $request->validate([
            'name' =>'required|max:255',
        ]);

        $coupon = new couponCode();
        $coupon->name = $request->name;
        $coupon->type = $request->type;
        $coupon->percent_amount = $request->percent_amount;
        $coupon->expire_date = $request->expire_date;
        $coupon->status = $request->status;
        $coupon->save();

        $notification = [
            'message' => 'Coupon added successfully!',
            'alert-type' =>'success'
        ];

        return redirect()->route('view_discount')->with($notification);
    }


    
    public function updatediscount(Request $request){

        if(empty($request->name)){
            $notification = [
                'message' => 'Name Field is required!',
                 'alert-type' =>'error'
             ];
     
             return redirect()->back()->with($notification);
        }

        $coupon = couponCode::find($request->id);
        $coupon->name = $request->name;
        $coupon->type = $request->type;
        $coupon->percent_amount = $request->percent_amount;
        $coupon->expire_date = $request->expire_date;
        $coupon->status = $request->status;
        $coupon->save();

        $notification = [
           'message' => 'Coupon updated successfully!',
            'alert-type' =>'success'
        ];

        return redirect()->back()->with($notification);
    }

    
    public function deletediscount($id){
        $coupon = couponCode::find($id);
        $coupon->isdelete = $coupon->status  = 1;
        $coupon->save();

        $notification = [
           'message' => 'Coupon deleted successfully!',
            'alert-type' =>'success'
        ];

        return redirect()->back()->with($notification);
    }

    


}
