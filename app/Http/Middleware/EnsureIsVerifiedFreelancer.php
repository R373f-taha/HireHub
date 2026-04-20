<?php

namespace App\Http\Middleware;

use App\Models\V1\Freelancer;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsVerifiedFreelancer
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

       if(strtolower($user->role) !=='freelancer'){
          return response()->json([
                'success' => false,
                'message' => 'Access denied. Only freelancers can perform this action.'
            ], 403);
       }
       $freelancer=$user->freelancer;

       if(!$freelancer || !$freelancer->is_verified){
           return response()->json([
                'success' => false,
                'message' => 'Access denied. Only Verified freelancers can perform this action.'
            ], 403);
       }
       return $next($request);

    }
}
