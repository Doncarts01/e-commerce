<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class page extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'pages';


    static public function getSingle($id){
        return self::find($id);
    }

    static public function getRecord(){
        return self::select('pages.*')->get();
    }


    function getPageImage(){
        if(!empty($this->image_name) && file_exists($this->image_name)){
            return url($this->image_name);
        }else{
            return '';
        }

    }

}
