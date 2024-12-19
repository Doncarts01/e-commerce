<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supportBrands extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'support_brands';


    static public function getRecord(){
        return self::select('support_brands.*')->get();
    }

    static public function getSingle($id){
        return self::find($id);
    }




}
