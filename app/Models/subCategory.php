<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Categories(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function products(){
        return $this->hasMany(Products::class, 'subcategory_id', 'id');
    }
    public function totalProducts(){
        return $this->hasMany(products::class, 'subcategory_id', 'id')
                    ->where('isdelete', 0)
                    ->where('status', 0)
                    ->count();
    }
}
