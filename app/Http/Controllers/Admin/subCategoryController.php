<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\subCategory;
use Illuminate\Support\Carbon;

class subCategoryController extends Controller
{
    //
    public function add_Subcategory(){
        $category = category::where('status', 0)->where('isdelete', 0)->orderBy('id', 'ASC')->get();
        return view('admin.create.addsubcategory', compact('category'));
    }
    public function storeSubCategory(Request $request){
        $request->validate([
            'name' =>'required|max:255',
            'category_id' => 'required'
        ]);

        $category = new subCategory();
        $category->name = $request->name;
        $category->category_id = $request->category_id;
        $category->status = $request->status;
        $category->save();

        $notification = [
            'message' => 'Sub Category added successfully!',
            'alert-type' =>'success'
        ];

        return redirect()->route('view_subcategories')->with($notification);
    }

    public function viewSubCategories(){
        $category = category::where('status', 0)->where('isdelete', 0)->orderBy('id', 'ASC')->get();
        $subCategory = subCategory::latest()->where('status', 0)->where('isdelete', 0)->orderBy('id', 'ASC')->get();
        return view('admin.pages.viewsubcategories', compact('subCategory', 'category'));
    }

    public function updateSubCategory(Request $request){

        if(empty($request->name)){
            $notification = [
                'message' => 'Name Field is required!',
                 'alert-type' =>'error'
             ];
     
             return redirect()->route('view_subcategories')->with($notification);
        }

        $category = subCategory::find($request->id);
        $category->name = $request->name;
        $category->category_id = $request->category_id;
        $category->status = $request->status;
        $category->save();

        $notification = [
           'message' => 'Sub Category updated successfully!',
            'alert-type' =>'success'
        ];

        return redirect()->back()->with($notification);
    }


    
    public function deleteSubCategory($id){
        $category = subCategory::find($id);
        $category->isdelete = $category->status  = 1;
        $category->save();

        // $notification = [
        //    'message' => 'Category deleted successfully!',
        //     'alert-type' =>'success'
        // ];

        return redirect()->back();
    }


    
    public function deleteSelectedSubCategories(Request $request)
    {
        $ids = $request->input('ids');

        if (is_array($ids) && count($ids) > 0) {
            subCategory::whereIn('id', $ids)->update(['isdelete' => 1]);

            return response()->json([
                'success' => true,
                'message' => 'Sub Categories successfully deleted.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No Sub categories selected.'
            ]);
        }
    }


    
    public function updateSelectedSubCategoriesStatus(Request $request)
    {
        $ids = $request->input('ids');
        $status = $request->input('status');

        if (is_array($ids) && count($ids) > 0 && in_array($status, [0, 1])) {
            subCategory::whereIn('id', $ids)->update(['status' => $status]);

            return response()->json([
                'success' => true,
                'message' => 'Sub Categories status successfully updated.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request.'
            ]);
        }
    }



    
    public function deletedSubCategories(){
        // $category = category::latest()->get();
        $subCategory = subCategory::latest()->where('isdelete', 1)->orWhere('status', 1)->get();
        return view('admin.pages.viewdeletedsubcategories', compact('subCategory')); 
    }


    
    public function restoreSubCategory($id){
        $category = subCategory::find($id);
        $category->isdelete = $category->status = 0;
        $category->save();

        // $notification = [
        //    'message' => 'Category restored successfully!',
        //     'alert-type' =>'success'
        // ];

        return redirect()->back();
    }
    
}
