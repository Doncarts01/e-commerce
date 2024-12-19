<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class category extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'categories';


    public function getSubCategory(){
        return $this->hasMany(subCategory::class, 'category_id', 'id')->where('status', 0)->where('isdelete', 0);
    }

    static public function ourCategories(){
        return self::select('categories.*')
        ->distinct()
        ->join('products', 'products.category_id', '=' ,'categories.id')
        ->where('categories.status', 0)
        ->where('categories.isdelete', 0)
        ->orderBy('categories.id', 'DESC')
        ->get();
    }

    function getCategoryImages(){
        if(!empty($this->image) && file_exists($this->image)){
            return url($this->image);
        }else{
            return '';
        }
    }

    public static function getProductCountByCategory($categoryId) {
        return DB::table('products')
            ->where('category_id', $categoryId)
            ->where('status', 0)
            ->where('isdelete', 0)
            ->count();
    }
    

    static public function menuCategory(){
        return self::select('categories.*')
        ->distinct()
        ->join('products', 'products.category_id', '=' ,'categories.id')
        ->where('categories.status', 0)
        ->where('categories.inMenu', 1)
        ->where('categories.isdelete', 0)
        ->orderBy('categories.id', 'DESC')
        ->limit(3)
        ->get();
    }






}



