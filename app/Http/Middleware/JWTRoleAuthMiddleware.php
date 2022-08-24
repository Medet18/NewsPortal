<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JWTRoleAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
          try{
            $token_role = $this->auth->parseToken()->getClaim('role');
          }catch(JWTException $e){
            return response()->json(['error'=>'UnAuthenticated'], 401);
          }

          if($token_role != $role){
            return reponse()->json(['error'=>'UnAuthenticated'],401);
          }

        return $next($request);
    }
}
