<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\brand;
use App\Models\category;
use App\Models\color;
use App\Models\myWishlist;
use App\Models\page;
use App\Models\product_review;
use App\Models\productColor;
use App\Models\productImage;
use App\Models\products;
use App\Models\productSize;
use App\Models\settings;
use App\Models\slider;
use App\Models\subCategory;
use App\Models\subscribers;
use App\Models\supportBrands;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class frontendController extends Controller
{


//     public function unsubscribePage($token)
// {
//     // Find the subscriber by token
//     $subscriber = subscribers::where('token', $token)->first();
//     Log::info('See subscriber:', ['subscriber' => $subscriber]);
//     if ($subscriber) {
//         return view('frontend.unsubscribe', compact($subscriber));
//     } else {
//         $notification = [
//             'message' => 'Subscriber not found.',
//             'alert-type' => 'error',
//         ];

//         return redirect()->route('frontend_index')->with($notification);
//     }
// }

    
    public function subscribe(Request $request){
        // dd($request->all());
        $request->validate([
            'email' =>'required|email|unique:subscribers',
        ]);

        $subscribers = new subscribers();
        $subscribers->email = $request->email;
        $subscribers->token = Str::random(32); // Generate a unique token
        $subscribers->save();

        $getSystemSettingsApp = settings::getSingle();

        // Email content
        $subject = "Welcome to Our Newsletter!";

        $message = '
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f8f8f8;
                        color: #333;
                        padding: 20px;
                    }
                    .email-container {
                        background-color: #ffffff;
                        border: 1px solid #ddd;
                        padding: 20px;
                        max-width: 600px;
                        margin: auto;
                    }
                    .email-header {
                        margin-bottom: 20px;
                        text-align: center;
                    }
                    .email-header h1 {
                        margin: 0;
                        font-size: 24px;
                        color: #333;
                    }
                    .email-header p {
                        margin: 5px 0;
                        font-size: 16px;
                        color: #666;
                    }
                    .email-body {
                        margin-bottom: 20px;
                        text-align: justify;
                    }
                    .email-body p {
                        margin: 5px 0;
                        font-size: 16px;
                        color: #666;
                    }
                    .email-footer {
                        margin-top: 20px;
                        text-align: justify;
                    }
                    .email-footer p {
                        margin: 5px 0;
                        font-size: 14px;
                        color: #666;
                    }
                </style>
            </head>
            <body>
                <div class="email-container">
                    <div class="email-header" style="margin-top: 30px">
                        <h1>Welcome to '. $getSystemSettingsApp->name .' Newsletter!</h1>
                    </div>
                    <div class="email-body">
                        <p>Dear '.$subscribers->email.',</p> <br>
                        <p>Thank you for subscribing to our newsletter! We’re thrilled to have you on board.</p>
                        <p>By joining our community, you’ll be the first to receive exclusive updates, special offers, and the latest news about our products and services. We aim to keep you informed and engaged with content that matters to you.</p>
                        <p>Stay tuned for exciting updates straight to your inbox.</p>
                    </div>
                    <div class="email-footer">
                        <p>If you have any questions or need assistance, feel free to reach out to us at '.$getSystemSettingsApp->contact_email.'. We are here to help!<br><br>
                            <b>Best Regards,</b>
                        </p>
                        <h5>'. $getSystemSettingsApp->name .'</h5>
                    </div>
                </div>
            </body>
        </html>';


        $emailSuccess = Mail::to($subscribers->email)->send(new Websitemail($subject, $message));


        $notification  = [
            'message' => 'You have successfully subscribed',
            'alert-type' =>'success'
        ];

        return redirect()->back()->with($notification);
    }

     
    public function FrontendIndex(){
        $data['products'] = products::newArrivals();
        $data['featuredProducts'] = products::featuredProducts();
        $data['featuredProductsLimit'] = products::featuredProductsLimit();
        $data['latestProductsLimit'] = products::latestProductsLimit();
        $data['topRatedProducts'] = products::getReviewRatingsLimit(3);
        $data['bestSellingLimit'] = products::bestSellingLimit(3);
        $data['ourCategories'] = category::ourCategories();
        $data['banner'] = slider::latest()->get();
        $data['supportBrands'] = supportBrands::getRecord();

        return view('frontend.index', $data);
    }

    public function myWishlist(){
        if(Auth::check()){
            $data['getProduct'] = products::getMyWishList(Auth::user()->id);
        }else{
            $data['getProduct'] = products::getMyWishList(Auth::guard('admin')->user()->id);
        }
        return view('frontend.wishlist', $data);
    }

    public function frontCategories($cat_id, $cat_name, $sub_id = null, $sub_name = null)
    {
        $categories = Category::findOrFail($cat_id);

        $getColors = color::where('isdelete', 0)
            ->where('status', 0)
            ->orderBy('name', 'ASC')
            ->get();

        $getBrands = brand::where('isdelete', 0)
            ->where('status', 0)
            ->orderBy('name', 'ASC')
            ->get();


        $getSubCatFilter = subCategory::where('category_id', $categories->id)
            ->where('isdelete', 0)
            ->where('status', 0)
            ->orderBy('name', 'ASC')
            ->get();

        $query = products::where('category_id', $categories->id)
            ->where('status', 0)
            ->where('isdelete', 0)
            ->orderBy('id', 'DESC');

        if ($sub_id) {
            $subCategory = SubCategory::findOrFail($sub_id);
            $products = $query->where('subcategory_id', $subCategory->id);
            $products = $query->paginate(30);
    
            return view('frontend.category', compact('categories', 'subCategory', 'products', 'getSubCatFilter', 'getColors', 'getBrands'));
        }else{
            $products = $query->paginate(30);
        }

        return view('frontend.category', compact('categories', 'products', 'getSubCatFilter', 'getColors', 'getBrands'));
    }
 


    function getFilterProductAjax(Request $request) {
        $searchTerm = $request->q;
        $getProducts = Products::where('status', 0)
                                ->where('isdelete', 0);
    
        if (!empty($searchTerm)) {
            $getProducts = $getProducts->where('title', 'like', '%' . $searchTerm . '%');
        }
    
        if (!empty($request->subCategoryId)) {
            $subCategory_id = rtrim($request->subCategoryId, ',');
            $subCategoryId_Array = explode(',', $subCategory_id);
            $getProducts = $getProducts->whereIn('subcategory_id', $subCategoryId_Array);
        } else {
            if (!empty($request->old_cat_id) && !empty($request->old_subcat_id)) {
                $getProducts = $getProducts->where('category_id', '=', $request->old_cat_id)
                                            ->where('subcategory_id', '=', $request->old_subcat_id);
            } else {
                if (!empty($request->old_cat_id)) {
                    $getProducts = $getProducts->where('category_id', '=', $request->old_cat_id);
                }
            }
        }

        if (!empty($request->brandId)) {
            $brandId = rtrim($request->brandId, ',');
            $brandId_Array = explode(',', $brandId);
            $getProducts = $getProducts->whereIn('brand_id', $brandId_Array);
        }


        if (!empty($request->colorId)) {
            $colorId = rtrim($request->colorId, ',');
            $colorId_Array = explode(',', $colorId);
            $getProducts = $getProducts->whereHas('productColor', function($query) use ($colorId_Array) {
                $query->whereIn('color_id', $colorId_Array);
            });
        }

        if (!empty($request->start_price) && !empty($request->end_price)) {
            $start_price = str_replace('$', '', $request->start_price);
            $end_price = str_replace('$', '', $request->end_price);
            $getProducts = $getProducts->where('price', '>=', $start_price)
                                        ->where('price', '<=', $end_price);
        }


        // Temporarily disable other filters for testing
        $getProducts = $getProducts->groupBy('id')
                                   ->orderBy('id', 'DESC')
                                   ->paginate(30);
    
        // Log the product count
        // Log::info('Product Count (search only): ' . $getProducts->count());
    
        return response()->json([
            'status' => true,
            'success' => view('frontend._category', [
                'products' => $getProducts,
            ])->render(),
        ], 200);
    }


    public function singleProductCat($cat_id, $cat_name, $sub_id = null, $sub_name = null, $id, $name)
    {
        $product = products::findOrFail($id);
        $relatedProducts = products::where('subcategory_id', $product->subcategory_id)
                                    ->where('id', '<>', $product->id)
                                    ->where('status', 0)
                                    ->where('isdelete', 0)
                                    ->groupBy('id')
                                    ->orderBy('id', 'DESC')
                                    ->limit(10)
                                    ->get();

        $getReviewProduct = product_review::getReviewProduct($product->id);
        return view('frontend.productDetails', compact('product', 'relatedProducts', 'getReviewProduct'));

    }


    public function searchProduct($cat_id=null, $cat_name=null, $sub_id = null, $sub_name = null){
        $search = $_GET['q'];

        if(!empty($cat_id)){
            $categories = Category::findOrFail($cat_id);
        }else{
            $categories = '';
        }

        $getColors = color::where('isdelete', 0)
            ->where('status', 0)
            ->orderBy('name', 'ASC')
            ->get();

        $getBrands = brand::where('isdelete', 0)
            ->where('status', 0)
            ->orderBy('name', 'ASC')
            ->get();

        $getSubCatFilter ='';

        if(!empty($categories)){
            $getSubCatFilter = subCategory::where('category_id', $categories->id)
            ->where('isdelete', 0)
            ->where('status', 0)
            ->orderBy('name', 'ASC')
            ->get();
        }

        $query = products::where('title', 'like', '%' . $search . '%')
        ->where('status', 0)
        ->where('isdelete', 0)
        ->orderBy('id', 'DESC');

        if ($sub_id) {
            $subCategory = SubCategory::findOrFail($sub_id);
            $products = $query->where('subcategory_id', $subCategory->id);
            $products = $query->paginate(30);
    
            return view('frontend.category', compact('categories', 'subCategory', 'products', 'getSubCatFilter', 'getColors', 'getBrands', 'search'));
        }else{
            $products = $query->paginate(30);
        }

        return view('frontend.category', compact('categories', 'products', 'getSubCatFilter', 'getColors', 'getBrands', 'search'));


    }
    

    public function contact(){
        $data['getSystemSettingsApp'] = settings::getSingle();
        $data['contact'] = page::getSingle(2);
        return view('frontend.contact', $data);
    }

    public function about(){
        $data['about'] = page::getSingle(1);
        return view('frontend.about', $data);
    }
    public function faq(){
        $data['faq'] =page::getSingle(3);
        return view('frontend.faq', $data);
    }
    public function paymentMethod(){
        $data['paymentMethod'] =page::getSingle(4);
        return view('frontend.paymentMethod', $data);
    }
    public function moneyBackGuarantee(){
        $data['moneyBackGuarantee'] =page::getSingle(5);
        return view('frontend.moneyBackGuarantee', $data);
    }
    public function shipping(){
        $data['shipping'] =page::getSingle(6);
        return view('frontend.shipping', $data);
    }
    public function returns(){
        $data['returns'] =page::getSingle(7);
        return view('frontend.returns', $data);
    }
    public function termsConditions(){
        $data['terms'] =page::getSingle(8);
        return view('frontend.termsConditions', $data);
    }
    public function privacyPolicy(){
        $data['privacy'] = page::getSingle(9);
        return view('frontend.privacyPolicy', $data);
    }


}
