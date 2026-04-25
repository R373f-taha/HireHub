<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class LogRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $start=microtime(true);
        $response=null;

   try{
       $response=$next($request);

        $duration =(microtime(true)- $start)*1000;

         $userId = Auth::user()?->id ?? 'guest';

         Log::info('API_REQUEST',[


        'method'=>$request->method(),
        'url'=>$request->url(),
        'duration_ms'=>round($duration,2),
        'ip'=>$request->ip(),
        'user_id'=>$userId,
        'user_email'=>Auth::user()->email ??'guest'

        ]); return $response;


    }

    catch(Throwable $e){

          $duration =(microtime(true)- $start)*1000;

            Log::error('API_REQUEST_FAILED',[
                'url'=>$request->fullUrl(),
                'code'=>$e->getCode(),
                'error'=>$e->getMessage(),
                'duration'=>round($duration,2)

            ]);
        }


      throw $e;

    }
}
