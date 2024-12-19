<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    use HasFactory;

    protected $guarded = [];


    static public function getSingle(){
        return self::find(1);
    }
    
    function getLogo(){
        if(!empty($this->logo) && file_exists($this->logo)){
            return url($this->logo);
        }else{
            return '';
        }

    }
    
    function getFavIcon(){
        if(!empty($this->favicon) && file_exists($this->favicon)){
            return url($this->favicon);
        }else{
            return '';
        }

    }

}
