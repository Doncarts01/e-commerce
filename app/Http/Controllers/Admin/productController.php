<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\category;
use App\Models\color;
use App\Models\productColor;
use App\Models\productImage;
use App\Models\products;
use App\Models\productSize;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class productController extends Controller
{
    //
    public function addProducts(){
        return view('admin.create.addproduct');
    }

    public function storeProduct(Request $request){
        $request->validate([
            'title' => 'required'
        ]);

        $product = new products();
        $product->title = $request->title;
        $product->save();

        $notification = [
            'message' =>'Product title created successfully', 
            'alert-type' => 'success'
        ];

        return redirect()->route('view_products')->with($notification);
    }

    public function viewProducts(){
        $products = products::latest()->where('isdelete', 0)->get();
        return view('admin.pages.viewproducts', compact('products'));
    }


    public function editProduct($id){
        $product = products::find($id);
        $getSubCategory = subCategory::where('id', $product->subcategory_id)->where('status', 0)->where('isdelete', 0)->orderBy('name', 'ASC')->get();
        $categories = category::where('status', 0)->where('isdelete', 0)->orderBy('name', 'ASC')->get();
        $brands = brand::where('status', 0)->where('isdelete', 0)->orderBy('name', 'ASC')->get();
        $colors = color::where('status', 0)->where('isdelete', 0)->orderBy('name', 'ASC')->get();
        return view('admin.edits.editProduct', compact('product', 'categories', 'brands', 'colors', 'getSubCategory'));
    }


    public function getSubCategory(Request $request){
        $category_id = $request->id;
        $getSubCategory = subCategory::where('category_id', $category_id)->where('status', 0)->where('isdelete', 0)->orderBy('name', 'ASC')->get();
        $html = "";
        $html .= "<option value=''>Select</option>";
        foreach ($getSubCategory as  $value) {
            $html .= "<option value='$value->id'> $value->name </option>";
        }
        return response()->json([
            'success'=> true,
            'html' => $html,
        ]); 
    }


    public function updateProduct(Request $request){
        // dd($request->all());
        $request_id = $request->id;

        $product = products::findOrFail($request_id);

        if(empty($request->category_id) || empty($request->subcategory_id)){
        // if(empty($request->category_id)){
            $notification = [
                'message' => 'Please select a category and a subcategory first', 
                'alert-type' => 'error',
            ];
    
            return redirect()->back()->with($notification);
        }

            $title = trim($request->title);
            $sku = $this->generateSKU($title);

        if(!empty($product)){
            products::findOrFail($request_id)->update([
                'title' => $title,
                'sku' => trim($sku),
                'category_id' => trim($request->category_id),
                'subcategory_id' => trim($request->subcategory_id),
                'brand_id' => trim($request->brand_id),
                'price' => trim($request->price),
                'old_price' => trim($request->old_price),
                'short_description' => trim($request->short_description),
                'description' => trim($request->description),
                'additional_information' => trim($request->additional_information),
                'shipping_returns' => trim($request->shipping_returns),
                'status' => trim($request->status),
            ]);

        productColor::DeleteRecord($product->id);

        if(!empty($request->color_id)){
            foreach ($request->color_id as $color_id) {
                $color = new productColor();
                $color->product_id = $product->id;
                $color->color_id = $color_id;
                $color->save();
            }
        }

        productSize::DeleteSizeRecord($product->id);

        if(!empty($request->size)){
            foreach ($request->size as $size) {
                if(!empty($size['name'])){
                    $saveSize = new productSize();
                    $saveSize->name = $size['name'];
                    $saveSize->price = !empty($size['price']) ? $size['price'] : 0;
                    $saveSize->product_id = $product->id;
                    $saveSize->save();
                }
            }
        }



        if (!empty($request->file('image'))) {
            foreach ($request->file('image') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $uniqueName = hexdec(uniqid()).'.'.$extension;
        
                    // Save normal image
                    $normalPath = 'upload/products/'.$uniqueName;
                    Image::make($image)->resize(300, 300)->save($normalPath);
        
                    // Save zoomed image
                    $zoomPath = 'upload/products/zoom/'.$uniqueName;
                    Image::make($image)->resize(800, 800)->save($zoomPath);
        
                    // Save paths in database
                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image_name = $normalPath;
                    $productImage->image_zoom = $zoomPath;
                    $productImage->image_extension = $extension;
                    $productImage->save();
                }
            }
        }
        

        $notification = [
            'message' => 'Product Successfully Updated', 
            'alert-type' => 'success',
        ];

        return redirect()->route('view_products')->with($notification);

        }else{
            abort(404);
        }

    }


    public function imageDelete($id){
        $image = productImage::find($id);
        if(!empty($image->getAllImages())){
            unlink($image->image_name);
        }

        if(!empty($image->getAllZoomImages())){
            unlink($image->image_zoom);
        }
 
        $image->delete();
        $notification = [
            'message' => 'Image Successfully Deleted', 
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }



    public function productImageSort(Request $request){
        if(!empty($request->photo_id)){
            $i = 1;
            foreach($request->photo_id as $photo_id){
                $image = productImage::find($photo_id);
                $image->order_by = $i;
                $image->save();
                $i++;
            }
        }

        $json['success'] = true;
        echo json_encode($json);
    }


    public function productFeature(Request $request){


        $getProduct = products::getSingle($request->product_id);
        $getProduct->isFeatured = $request->status;
        $getProduct->save();

            return response()->json([
                'message' => 'Product Feature successfully updated.',
                'success' => true,
            ]);

    }


    public function deleteProduct($id){
        $getProduct = products::getSingle($id);
        $getProduct->isdelete = 1;
        $getProduct->save();

        $notification = [
            'message' => 'Product Successfully Deleted', 
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }



     private function generateSKU($productName)
    {
        // Get the first 3 letters of the product name, and convert to uppercase
        $prefix = strtoupper(substr($productName, 0, 3));
        
        // Generate a unique identifier (you can use Str::random for this)
        $uniqueId = strtoupper(Str::random(8)); // Adjust length as needed

        // Combine the prefix and the unique identifier to create the SKU
        $sku = $prefix . '-' . $uniqueId;

        return $sku;
    }
}
