<?php

namespace App\Http\Middleware;

use Closure;

class TokenAuth
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
       /* $token = $request->header('X-API-TOKEN');
        if('X-API-TOKEN' != $token) // check
        {
            abort(401, 'Auth Token not found');
        }*/
        return $next($request);
    }
}
