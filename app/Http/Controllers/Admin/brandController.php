<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\brand;
use App\Models\supportBrands;
use Illuminate\Support\Carbon;

class brandController extends Controller
{
      //
      public function addBrand(){
        return view('admin.create.addbrand');
    }

    public function storeBrand(Request $request){
        $request->validate([
            'name' =>'required|max:255',
        ]);

        $brand = new brand();
        $brand->name = $request->name;
        $brand->status = $request->status;
        $brand->save();

        $notification = [
            'message' => 'Brand added successfully!',
            'alert-type' =>'success'
        ];

        return redirect()->route('view_brands')->with($notification);
    }

    public function viewBrands(){
        $brand = brand::latest()->where('status', 0)->where('isdelete', 0)->orderBy('id', 'ASC')->get();
        return view('admin.pages.viewbrand', compact('brand'));
    }


    public function deletedBrands(){
        $brand = brand::latest()->where('isdelete', 1)->orWhere('status', 1)->get();
        return view('admin.pages.viewdeletedbrands', compact('brand')); 
    }

    public function deleteBrand($id){
        $brand = brand::find($id);
        $brand->isdelete = $brand->status  = 1;
        $brand->save();

        return redirect()->route('view_brands');
    }

    public function restoreBrand($id){
        $brand = brand::find($id);
        $brand->isdelete = $brand->status = 0;
        $brand->save();

        $notification = [
           'message' => 'Brand restored successfully!',
            'alert-type' =>'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function updateBrand(Request $request){

        if(empty($request->name)){
            $notification = [
                'message' => 'Name Field is required!',
                 'alert-type' =>'error'
             ];
     
             return redirect()->back()->with($notification);
        }

        $brand = brand::find($request->id);
        $brand->name = $request->name;
        $brand->status = $request->status;
        $brand->save();

        $notification = [
           'message' => 'Brand updated successfully!',
            'alert-type' =>'success'
        ];

        return redirect()->back()->with($notification);
    }


    public function deleteSelectedBrands(Request $request)
    {
        $ids = $request->input('ids');

        if (is_array($ids) && count($ids) > 0) {
            brand::whereIn('id', $ids)->update(['isdelete' => 1]);

            return response()->json([
                'success' => true,
                'message' => 'Brands successfully deleted.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No Brands selected.'
            ]);
        }
    }

    public function updateSelectedBrandsStatus(Request $request)
    {
        $ids = $request->input('ids');
        $status = $request->input('status');

        if (is_array($ids) && count($ids) > 0 && in_array($status, [0, 1])) {
            brand::whereIn('id', $ids)->update(['status' => $status]);

            return response()->json([
                'success' => true,
                'message' => 'Brand status successfully updated.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request.'
            ]);
        }
    }



}
