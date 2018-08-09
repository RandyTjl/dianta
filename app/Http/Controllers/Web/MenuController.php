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

class MenuController extends BaseController{

    public function index(){
        $menus  = Session::get('menus');
        $user_id = Session::get('user_id');
        $role_ids = UserRole::getRoleId($user_id);
        $menu_ids = MenuRole::getMenuId($role_ids);
        $menu_list = $this->menu_list($menus);
        $menuAll = Menu::getAllMenu();
        return view("menu/index",['menu_list'=>$menu_list,'menu_id'=>$menu_ids,'menuAll'=>$menuAll]);
    }

    public function store(){
        $input = Input::get();
        unset($input['id']);
        if(empty($input['is_del'])){
            $input['is_del'] = 0;
        }
        $a = Menu::create($input);
        if($a){
            return $this->success();
        }
        return $this->fail(200004);
    }

    public function show($menu_id){
        $menu = Menu::find($menu_id);
        return $this->success($menu);
    }


    public function update($menu_id){
        $input = Input::get();
        unset($input['id']);
        if(empty($input['is_del'])){
            $input['is_del'] = 0;
        }
        $a = Menu::where('id',$menu_id)->update($input);
        if($a){
            return $this->success();
        }
        return $this->fail(200005);
    }



    public function menu_list($menus,$level=0){
        $html = '';
        $left_class = "padding-left:".(10*($level))."px";
        $size = "font-size:".(18-$level)."px";
        foreach ($menus as $key=>$menu){
            if(isset($menu['_chirld'])){

                $html .= '<li class=" has-treeview menu-open" style="'.$left_class.'">
                            <a  menu_id ="'.$menu['id'].'" class="nav-link " style="'.$size.'">
                              <i class="nav-icon fa '.$menu['icon'].'"></i>
                              <p>
                                '.$menu['menu_name'].'
                                <i class="right fa fa-angle-left"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">';

                $html .= $this->menu_list($menu['_chirld'],$level+1);

                $html .= '</ul></li>';
            }else {
                $html .= '<li class="" style="'.$left_class.'">
                <a menu_id ="'.$menu['id'].'" class="nav-link " style="'.$size.'">
                  <i class="fa  ' . $menu['icon'] . ' nav-icon"></i>
                   ' . $menu['menu_name'] . '
                </a>
              </li>';
            }
        }
        return $html;
    }



}