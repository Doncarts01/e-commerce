<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';
    protected $guarded = [];

    static public function getSingle($id){
        return self::find($id);
    }

    static public function insertRecord($user_id, $url, $message, $is_Admin){
        $save = new notification();
        $save->user_id = $user_id;
        $save->url = $url;
        $save->is_Admin = $is_Admin;
        $save->message = $message;
        $save->save();
    }

    static public function getUnreadNotification(){
        return self::where('is_read', 0)
                            ->where('is_Admin', 0 )
                            ->orderBy('id', 'desc')
                            ->get();
    }


    static public function getRecord(){
        return self::where('is_Admin', 0 )
                    ->orderBy('id', 'desc')
                    ->paginate(30);
    }







    static public function getUserRecord($id){
        return self::where('is_Admin', 1 )
                    ->where('user_id', $id )
                    ->orderBy('id', 'desc')
                    ->paginate(30);
    }


    static public function getUnreadUserNotification($id){
        return self::where('is_read', 0)
                            ->where('is_Admin', 1 )
                            ->where('user_id', $id )
                            ->orderBy('id', 'desc')
                            ->get();
    }

}
