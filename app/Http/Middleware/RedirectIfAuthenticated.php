<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Web\AuthController;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RedirectIfAuthenticated
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

        if (!Auth::guard($guard)->check() || empty(Session::get('user_id'))) {
            return redirect('/login');
        }

       /* if(empty(Session::get('user_id'))){
            $user = Auth::guard($guard)->user();
            $auth = new AuthController();
            $menus = $auth->user_menu($user->id);
            $top_menu = createTopMenu($menus);
            Session::put('user_id',$user->id);
            Session::put('user',$user);
            Session::put('top_menu',$top_menu);
            Session::put('menus',$menus);
            Session::save();
        }*/

        return $next($request);
    }
}
