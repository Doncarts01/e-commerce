<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class categoryController extends Controller
{
    //
    public function addCategory(){
        return view('admin.create.addcategory');
    }

    public function storeCategory(Request $request){
        $request->validate([
            'name' =>'required|max:255',
        ]);

        $category = new category();
        $category->name = $request->name;
        $category->status = $request->status;
        $category->inMenu = $request->inMenu;
        $category->save();

        $notification = [
            'message' => 'Category added successfully!',
            'alert-type' =>'success'
        ];

        return redirect()->route('view_categories')->with($notification);
    }

    public function viewCategories(){
        $categories = category::latest()->where('status', 0)->where('isdelete', 0)->orderBy('id', 'ASC')->get();
        return view('admin.pages.viewcategories', compact('categories'));
    }


    public function deletedCategories(){
        $categories = category::latest()->where('isdelete', 1)->orWhere('status', 1)->get();
        return view('admin.pages.viewdeletedcategories', compact('categories')); 
    }

    public function deleteCategory($id){
        $category = category::find($id);
        $category->isdelete = $category->status  = 1;
        $category->save();

        // $notification = [
        //    'message' => 'Category deleted successfully!',
        //     'alert-type' =>'success'
        // ];

        return redirect()->back();
    }

    public function restoreCategory($id){
        $category = category::find($id);
        $category->isdelete = $category->status = 0;
        $category->save();

        // $notification = [
        //    'message' => 'Category restored successfully!',
        //     'alert-type' =>'success'
        // ];

        return redirect()->back();
    }

    public function updateCategory(Request $request){

        // dd($request->all());

        if(empty($request->name)){
            $notification = [
                'message' => 'Name Field is required!',
                 'alert-type' =>'error'
             ];
     
             return redirect()->route('view_categories')->with($notification);
        }

        $category = category::find($request->id);
        $category->name = $request->name;
        $category->status = $request->status;
        $category->inMenu = $request->inMenu;


        if (!empty($request->file('image'))) {

            if(!empty($category->image)){
                unlink($category->image);
                $category->image = "";
            }

            if ($request->file('image')->isValid()) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $uniqueName = hexdec(uniqid()).'.'.$extension;

                // Save normal image
                $normalPath = 'upload/category/'.$uniqueName;
                Image::make($image)->save($normalPath);
                $category->image = $normalPath;
            }
        }

        $category->save();

        $notification = [
           'message' => 'Category updated successfully!',
            'alert-type' =>'success'
        ];

        return redirect()->back()->with($notification);
    }


    public function deleteSelectedCategories(Request $request)
    {
        $ids = $request->input('ids');

        if (is_array($ids) && count($ids) > 0) {
            Category::whereIn('id', $ids)->update(['isdelete' => 1]);

            return response()->json([
                'success' => true,
                'message' => 'Categories successfully deleted.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No categories selected.'
            ]);
        }
    }

    public function updateSelectedCategoriesStatus(Request $request)
    {
        $ids = $request->input('ids');
        $status = $request->input('status');

        if (is_array($ids) && count($ids) > 0 && in_array($status, [0, 1])) {
            Category::whereIn('id', $ids)->update(['status' => $status]);

            return response()->json([
                'success' => true,
                'message' => 'Categories status successfully updated.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request.'
            ]);
        }
    }


}
