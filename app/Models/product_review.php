<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class product_review extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'product_reviews';

    static public function getSingle($id){
        return self::find($id);
    }


    static public function getReview($product_id, $order_id, $user_id){
        return self::select('*')
                    ->where('product_id', $product_id)
                    ->where('order_id', $order_id)
                    ->where('user_id', $user_id)
                    ->first();
    }

    static public function getReviewProduct($product_id){
        return self::select('product_reviews.*', 'users.name', 'users.profile_image')
                    ->join('users', 'users.id' , 'product_reviews.user_id')
                    ->where('product_id', $product_id)
                    ->orderBy('product_reviews.id', 'DESC')
                    ->paginate(20);
    }


    static function getRatingAVG($product_id){
        return self::select('product_reviews.rating')
                    ->join('users', 'users.id' , 'product_reviews.user_id')
                    ->where('product_id', $product_id)
                    ->avg('product_reviews.rating');
    }


    // ProductReview.php (Model)
static function getRatingAVGLimit($product_id){
    return self::where('product_id', $product_id)
               ->avg('rating');
}






}
