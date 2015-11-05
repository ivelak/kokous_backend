<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Admin::notAdmin()) {
            return redirect('/');
        }
            
        return $next($request);
    }
}