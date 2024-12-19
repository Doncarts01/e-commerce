<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;

    protected $table = 'orders';


    // FOR USERS

    static public function getTotalOrderUser($user_id){
        return self::select('id')
                    ->where('user_id', $user_id)
                    ->where('isPayment', '=', 1)
                    ->where('isdelete', '=', 0)
                    ->count();
    }

    static public function todayOrdersUser($user_id){
        return self::select('id')
                    ->where('user_id', $user_id)
                    ->where('isPayment', '=', 1)
                    ->where('isdelete', '=', 0)
                    ->whereDate('created_at', '=', date('Y-m-d'))
                    ->count();
    }

    static public function totalAmountUser($user_id){
        return self::select('id')
                    ->where('user_id', $user_id)
                    ->where('isPayment', '=', 1)
                    ->where('isdelete', '=', 0)
                    ->sum('total_amount');
    }
    static public function todayTotalAmountUser($user_id){
        return self::select('id')
                    ->where('user_id', $user_id)
                    ->where('isPayment', '=', 1)
                    ->where('isdelete', '=', 0)
                    ->whereDate('created_at', '=', date('Y-m-d'))
                    ->sum('total_amount');
    }

    static public function totalStatusUser($user_id, $status){
        return self::select('id')
                    ->where('user_id', $user_id)
                    ->where('status', $status)
                    ->where('isPayment', '=', 1)
                    ->where('isdelete', '=', 0)
                    ->count();
    }

    static public function getRecordUser($user_id){
        return self::select('orders.*')
                    ->where('user_id', $user_id)
                    ->where('orders.isPayment', '=', 1)
                    ->where('orders.isdelete', '=', 0)
                    ->orderBy('orders.id', 'desc')
                    ->get();
    }

    // static public function getSingleUserOrder($user_id, $id){
    //     return self::select('orders.*')
    //                 ->where('user_id', $user_id)
    //                 ->where('id', $id)
    //                 ->where('orders.isPayment', '=', 1)
    //                 ->where('orders.isdelete', '=', 0)
    //                 ->orderBy('orders.id', 'desc')
    //                 ->get();
    // }

    // END USERS 

    static public function getTotalOrder(){
        return self::select('id')
                    ->where('isPayment', '=', 1)
                    ->where('isdelete', '=', 0)
                    ->count();
    }

    static public function todayOrders(){
        return self::select('id')
                    ->where('isPayment', '=', 1)
                    ->where('isdelete', '=', 0)
                    ->whereDate('created_at', '=', date('Y-m-d'))
                    ->count();
    }
    static public function totalAmount(){
        return self::select('id')
                    ->where('isPayment', '=', 1)
                    ->where('isdelete', '=', 0)
                    ->sum('total_amount');
    }
    static public function todayTotalAmount(){
        return self::select('id')
                    ->where('isPayment', '=', 1)
                    ->where('isdelete', '=', 0)
                    ->whereDate('created_at', '=', date('Y-m-d'))
                    ->sum('total_amount');
    }


    static public function latestOrders(){
        return self::select('orders.*')
                    ->where('orders.isPayment', '=', 1)
                    ->where('orders.isdelete', '=', 0)
                    ->orderBy('orders.id', 'desc')
                    ->limit(10)
                    ->get();
    }


    static public function getRecord(){
        return self::select('orders.*')
                    ->where('orders.isPayment', '=', 1)
                    ->where('orders.isdelete', '=', 0)
                    ->orderBy('orders.id', 'desc')
                    ->get();
    }


    static public function getSingle($id){
        return self::find($id);
    }


    public function getShipping(){
        return $this->belongsTo(shippingCharge::class, 'shipping_id');
    }
    
    public function getItem(){
        return $this->hasMany(order_item::class, 'order_id');
    }



    static public function getTotalOrderMonth($start_date, $end_date){
        return self::select('id')
                    ->where('isPayment', '=', 1)
                    ->where('isdelete', '=', 0)
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->count();
    }


    static public function getTotalOrderAmountMonth($start_date, $end_date){
        return self::select('id')
                    ->where('isPayment', '=', 1)
                    ->where('isdelete', '=', 0)
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->sum('total_amount');
    }

}
