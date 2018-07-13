<?php
/**
 * Created by PhpStorm.
 * User: Randy
 * Date: 2018/7/11
 * Time: 17:22
 */
namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Models\UserRole;
use App\Models\MenuRole;

class PowerController extends BaseController{

    public function index(){
        $menus  = Session::get('menus');
        $user_id = Session::get('user_id');
        $role_ids = UserRole::getRoleId($user_id);
        $menu_ids = MenuRole::getMenuId($role_ids);
        return view("power/index",['menus'=>$menus,'menu_id'=>$menu_ids]);
    }

}