<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class order_item extends Model
{
    use HasFactory;

    protected $table = 'order_items';


    public function getProduct(){
        return $this->belongsTo(products::class, 'product_id', 'id');
    }


    static public function getReview($product_id, $order_id){
        return product_review::getReview($product_id, $order_id, Auth::user()->id); 
    }


}
