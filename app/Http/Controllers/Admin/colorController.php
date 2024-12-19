<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\brand;
use App\Models\color;
use Illuminate\Support\Carbon;

class colorController extends Controller
{
    
    public function addColor(){
        return view('admin.create.addColor');
    }

    public function storeColor(Request $request){
        $request->validate([
            'name' =>'required|max:255',
            'code' => 'required'
        ]);

        $color = new color();
        $color->name = $request->name;
        $color->code = $request->code;
        $color->status = $request->status;
        $color->save();

        $notification = [
            'message' => 'Color added successfully!',
            'alert-type' =>'success'
        ];

        return redirect()->route('view_colors')->with($notification);
    }

    
    public function viewColor(){
        $color = color::where('isdelete', 0)->where('status', 0)->orderBy('id', 'ASC')->get();
        return view('admin.pages.viewcolors', compact('color'));
    }

    
    public function updateColor(Request $request){

        if(empty($request->name)){
            $notification = [
                'message' => 'Name Field is required!',
                 'alert-type' =>'error'
             ];
     
             return redirect()->back()->with($notification);
        }

        $color = color::find($request->id);
        $color->name = $request->name;
        $color->code = $request->code;
        $color->status = $request->status;
        $color->save();

        $notification = [
           'message' => 'Color updated successfully!',
            'alert-type' =>'success'
        ];

        return redirect()->back()->with($notification);
    }

    
    public function deleteColor($id){
        $color = color::find($id);
        $color->isdelete = $color->status  = 1;
        $color->save();

        // $notification = [
        //    'message' => 'Category deleted successfully!',
        //     'alert-type' =>'success'
        // ];

        return redirect()->back();
    }

    
    public function deleteSelectedColors(Request $request)
    {
        $ids = $request->input('ids');

        if (is_array($ids) && count($ids) > 0) {
            color::whereIn('id', $ids)->update(['isdelete' => 1]);

            return response()->json([
                'success' => true,
                'message' => 'Colors successfully deleted.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No colors selected.'
            ]);
        }
    }


    public function updateSelectedColorStatus(Request $request)
    {
        $ids = $request->input('ids');
        $status = $request->input('status');

        if (is_array($ids) && count($ids) > 0 && in_array($status, [0, 1])) {
            color::whereIn('id', $ids)->update(['status' => $status]);

            return response()->json([
                'success' => true,
                'message' => 'Colors status successfully updated.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request.'
            ]);
        }
    }

    

    public function deletedColors(){
        $color = color::latest()->where('isdelete', 1)->orWhere('status', 1)->get();
        return view('admin.pages.viewdeletedcolors', compact('color')); 
    }

    
    public function restoreColor($id){
        $color = color::find($id);
        $color->isdelete = $color->status = 0;
        $color->save();

        // $notification = [
        //    'message' => 'Category restored successfully!',
        //     'alert-type' =>'success'
        // ];

        return redirect()->back();
    }



}
