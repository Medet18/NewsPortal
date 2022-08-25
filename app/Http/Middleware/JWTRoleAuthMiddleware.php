<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnaothorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JWTRoleAuthMiddleware extends BaseMiddleware
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
          } catch(JWTException $e){
            return response()->json(['error'=>'UnAuthenticated'], 401);
          }

          if($token_role != $role){
            return response()->json(['error'=>'Unauthenticated'],401);
          }

        return $next($request);
    }
}

    // public function handle($request, Closure $next){
    //     try {
    //         $user = JWTAuth::parseToken()->authenticate();
    //     } catch (Exception $e) {
    //         if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
    //             $status     = 401;
    //             $message    = 'This token is invalid. Please Login';
    //             return response()->json(compact('status','message'),401);
    //         }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
    //             // If the token is expired, then it will be refreshed and added to the headers
    //             try
    //             {
    //               $refreshed = JWTAuth::refresh(JWTAuth::getToken());
    //               $user = JWTAuth::setToken($refreshed)->toUser();
    //               $request->headers->set('Authorization','Bearer '.$refreshed);
    //             }catch (JWTException $e){
    //                 return response()->json([
    //                     'code'   => 103,
    //                     'message' => 'Token cannot be refreshed, please Login again'
    //                 ]);
    //             }
    //         }else{
    //             $message = 'Authorization Token not found';
    //             return response()->json(compact('message'), 404);
    //         }
    //     }
    //     return $next($request);
    // }

