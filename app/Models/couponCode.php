<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class couponCode extends Model
{
    use HasFactory;

    protected $table = 'coupon_codes';

    static public function getSingle($id){
        return self::find($id);
    }
    static public function getRecord(){
        return self::select('coupon_codes.*')
                    ->where('coupon_codes.status', '=', 0)
                    ->where('coupon_codes.isdelete', '=', 0)
                    ->orderBy('coupon_codes.id', 'desc')
                    ->get();
    }

    static public function checkCouponCode($couponCode){
            return self::select('coupon_codes.*')
                        ->where('coupon_codes.name', '=', $couponCode)
                        ->where('coupon_codes.expire_date', '>=', date('Y-m-d'))
                        ->where('coupon_codes.status', '=', 0)
                        ->where('coupon_codes.isdelete', '=', 0)
                        ->first();
    }


}
