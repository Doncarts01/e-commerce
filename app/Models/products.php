<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class products extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'products';


    static public function getMyWishList($user_id){
        return self::select('products.*')
                    ->join('product_wishlists', 'product_wishlists.product_id', '=' ,'products.id')
                    ->where('product_wishlists.user_id', $user_id)
                    ->where('status', 0)
                    ->where('isdelete', 0)
                    ->orderBy('id', 'DESC')
                    ->paginate(10);
    }

    static public function newArrivals(){
        return self::select('products.*')
                    ->where('category_id', '<>', 0)
                    ->where('subcategory_id', '<>', 0)
                    ->where('status', 0)
                    ->where('isdelete', 0)
                    ->orderBy('id', 'DESC')
                    ->limit(10)
                    ->get();
    }

    static public function latestProductsLimit(){
        return self::select('products.*')
                    ->where('category_id', '<>', 0)
                    ->where('subcategory_id', '<>', 0)
                    ->where('status', 0)
                    ->where('isdelete', 0)
                    ->orderBy('id', 'DESC')
                    ->limit(3)
                    ->get();
    }

    static public function featuredProducts(){
        return self::select('products.*')
                    ->where('status', 0)
                    ->where('isFeatured', 1)
                    ->where('category_id', '<>', 0)
                    ->where('subcategory_id', '<>', 0)
                    ->where('isdelete', 0)
                    ->orderBy('id', 'DESC')
                    ->limit(10)
                    ->get();
    }
    static public function featuredProductsLimit(){
        return self::select('products.*')
                    ->where('category_id', '<>', 0)
                    ->where('subcategory_id', '<>', 0)
                    ->where('status', 0)
                    ->where('isFeatured', 1)
                    ->where('isdelete', 0)
                    ->orderBy('id', 'DESC')
                    ->limit(3)
                    ->get();
    }


    public function productCategory(){
        return $this->belongsTo(category::class, 'category_id', 'id');
    }
    public function productSubCategory(){
        return $this->belongsTo(subCategory::class, 'subcategory_id', 'id');
    }

    public function productBrand(){
        return $this->belongsTo(brand::class, 'brand_id', 'id');
    }

    public function getColor(){
        return $this->hasMany(productColor::class, 'product_id');
    }

    public function getSize(){
        return $this->hasMany(productSize::class, 'product_id');
    }

    public function getImage(){
        return $this->hasMany(productImage::class, 'product_id')->orderBy('order_by', 'ASC');
    }

    public function getFirstImage(){
        $firstImage = productImage::where('product_id', $this->id)
            ->orderBy('order_by', 'ASC')
            ->take(2)
            ->get();

            return $firstImage->first();
    }

    public function getFirstAndSecondImages() {
        return productImage::where('product_id', $this->id)
            ->orderBy('order_by', 'ASC')
            ->take(2)
            ->get();

    }

    public function productColor() {
        return $this->hasMany(ProductColor::class, 'product_id');
    }

    static public function getSingle($id){
        return self::find($id);
    }


    public function checkWishList($product_id){
        if(Auth::check()){
            return product_wishlist::checkAlready($product_id, Auth::user()->id );

        }else{
            return product_wishlist::checkAlready($product_id, Auth::guard('admin')->user()->id);

        }
    }


    public function getTotalReview() {
        return $this->hasMany(product_review::class, 'product_id')
                    ->join('users', 'users.id' , 'product_reviews.user_id')
                    ->count();
    }

    static function getReviewRatings($product_id){
        $avg = product_review::getRatingAVG($product_id);
        if($avg > 0){
            // $avg = floor($avg);
            return $avg;
        }else{
            return 0;
        }
    }

// Product.php (Model)
    static function getReviewRatingsLimit($limit = 3){
        return self::select('products.*')
                ->join('product_reviews', 'products.id', '=', 'product_reviews.product_id')
                ->selectRaw('AVG(product_reviews.rating) as average_rating')
                ->groupBy('products.id')
                ->orderBy('average_rating', 'DESC')
                ->limit($limit)
                ->get();
    }

    static function bestSellingLimit($limit = 3){
        return self::select('products.*')
                ->join('order_items', 'products.id', '=', 'order_items.product_id')
                ->selectRaw('COUNT(order_items.product_id) as bestSelling_count')
                ->groupBy('products.id')
                ->orderBy('bestSelling_count', 'DESC')
                ->limit($limit)
                ->get();
    }


}
