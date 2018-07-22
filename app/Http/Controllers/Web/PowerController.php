<?php
/**
 * Created by PhpStorm.
 * User: Randy
 * Date: 2018/7/11
 * Time: 17:22
 */
namespace App\Http\Controllers\Web;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Input;
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

    public function store(){
        $input = Input::get();
        $a = Menu::create($input);
        if($a){
            return $this->success();
        }
        return $this->fail(200004);
    }

    public function show($menu_id){
        $menu = Menu::find($menu_id);
        return $menu;
    }


    public function update($menu_id){
        $input = Input::get();
        $a = Menu::where('id',$menu_id)->update($input);
        if($a){
            return $this->success();
        }
        return $this->fail(200005);
    }

    public function destroy($menu_id){
        $a = Menu::where('id',$menu_id)->update(['is_del'=>1]);
        if($a){
            return $this->success();
        }
        return $this->fail(200006);
    }



}