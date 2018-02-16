<?php

namespace App\Http\Middleware;
use Tymon\JWTAuth\Facades\JWTAuth;


use Closure;

class Authorization
{
    /**
     * checks authorization for an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $loggedInUser = JWTAuth::parseToken()->toUser()->id;
        $userId = $request->route()[2]["userId"];

        if($loggedInUser != $userId ) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
