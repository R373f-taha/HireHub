<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    if(!Auth::check()){
                return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

       $user=Auth::user();

       if(strtolower($user->role)  !=='client'){
          return response()->json([
                'success' => false,
                'message' => 'Access denied. Only clients can perform this action.'
            ], 403);
       }
        return $next($request);
    }
}
