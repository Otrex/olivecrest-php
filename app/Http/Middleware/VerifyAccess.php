<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class VerifyAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()->is_verified){
            return Response(json_encode(['err' => 'User not verified']), 400);
        }      
        if (!Auth::user()->is_token_verified){
            return Response(json_encode(['err' => 'Access Token not verified']), 400);
        }
        return $next($request);
    }
}
