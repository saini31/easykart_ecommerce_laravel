<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class disable_btn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);
        $response = $next($request);
        $response->headers->set('Cache-Control', 'nocache, no-store,max-age=0,must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('experies', 'Mon 02jan 2023 00:00:00 GMT');
        return $response;
    }
}
