<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Illuminate\Http\Request;

class AdminAuthenticate
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
        if($request->session()->get('admin_login'))
            return $next($request);
        else
            return redirect()->route('admin.login');
    }
}
