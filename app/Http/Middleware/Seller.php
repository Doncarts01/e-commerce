<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use illuminate\Support\Facades\Auth;


class Seller
{
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::guard('seller')->check()){
            return redirect()->route("seller_login")->with('error', 'You do not have permission to access this page');
        }
        return $next($request);
    }


}
