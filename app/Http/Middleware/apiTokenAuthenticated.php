<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Web\AuthController;
use Closure;
use Illuminate\Http\Request;



class apiTokenAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $request = new Request();
        $apiToken = $request->header('apiToken');
        if(empty($apiToken)){
            return response()->json(['status'  => false, 'code'    => 300002, 'message' => config('apicode.code')[(int) 300002],]);
        }

        return $next($request);
    }
}
