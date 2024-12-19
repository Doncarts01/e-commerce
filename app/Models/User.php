<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];




    static public function totalTodayCustomers(){
        return self::select('id')
                    ->where('isdelete', '=', 0)
                    ->whereDate('created_at', '=', date('Y-m-d'))
                    ->count();
    }


    static public function totalCustomers(){
        return self::select('id')
                    ->where('isdelete', '=', 0)
                    ->count();
    }


    static public function getTotalCustomerMonth($start_date, $end_date){
        return self::select('id')
                    ->where('isdelete', '=', 0)
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->count();
    }




}
