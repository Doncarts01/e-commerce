<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paymentSettings extends Model
{
    use HasFactory;

    protected $guarded = [];


    static public function getSingle(){
        return self::find(1);
    }
}
