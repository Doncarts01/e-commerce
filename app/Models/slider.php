<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'sliders';

    static public function getRecord(){
        return self::select('sliders.*')->get();
    }

    static public function getSingle($id){
        return self::find($id);
    }









}
