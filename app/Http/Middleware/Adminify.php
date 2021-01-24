<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Adminify
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
        $request->is_admin = true;
        return $next($request);
    }
}
