<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserRole;
use App\Models\MenuRole;
use App\Models\Menu;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class AuthController extends BaseController
{

    public function login(Request $request){

        $email = $request->get('email');
        $password = $request->get('password');
        $remember_token = empty($request->get('remember_token'))? false : true;

        $user = User::getUserByEmail($email);

        if(!empty($user)  && $user->is_del == 1){
            return $this->fail(200003);
        }

        if (Auth::guard('Web')->attempt(['email' => $email, 'password' => $password],$remember_token)) {

            $menus = $this->user_menu($user->id);
            $top_menu = createTopMenu($menus);
            Session::put('user_id',$user->id);
            Session::put('user',$user);
            Session::put('top_menu',$top_menu);
            Session::put('menus',$menus);
            Session::save();

            return $this->success();
        }else{
            return $this->fail(200002);
        }
    }


    public function user_menu($user_id){
        $role_ids = UserRole::getRoleId($user_id);
        $menu_ids = MenuRole::getMenuId($role_ids);
        $menus = Menu::getMenu($menu_ids);
        $menus = left_menu_tree($menus);
        return $menus;
    }

}
