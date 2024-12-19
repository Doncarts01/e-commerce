<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productColor extends Model
{
    use HasFactory;

    protected $gaurded = [];


    static function DeleteRecord($product_id){
        self::where('product_id', $product_id)->delete(); 
    }

    public function getProductColor()
    {
        return $this->belongsTo(color::class, 'color_id', 'id');
    }

    static public function getSingle($id){
        return self::find($id);
    }

}
