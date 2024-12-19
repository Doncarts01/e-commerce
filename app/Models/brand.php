<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function totalBrands(){
        return $this->hasMany(products::class, 'brand_id', 'id')
                    ->where('isdelete', 0)
                    ->where('status', 0)
                    ->count();
    }
}
