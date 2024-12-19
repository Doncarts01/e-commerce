<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productSize extends Model
{
    use HasFactory;

    protected $guarded = [];

    static function DeleteSizeRecord($product_id){
        self::where('product_id', $product_id)->delete(); 
    }

    static public function getSingle($id){
        return self::find($id);
    }

}
