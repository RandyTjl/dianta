<?php
/**
 * Created by PhpStorm.
 * User: Randy
 * Date: 2018/7/11
 * Time: 17:22
 */
namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Support\Facades\Input;
use App\Models\Role;
use Illuminate\Support\Facades\Session;
use App\Models\MenuRole;
use Illuminate\Support\Facades\Hash;

class RoleController extends BaseController{

    public function index(){
        $roles = Role::paginate(15);
        return view("role/index",['datas'=>$roles]);

    }

    public function create(){
        return view('role/create');
    }

    public function store(){
        $data = Input::all();
        $menu_ids = Input::get('menu_ids');

        $a = Role::create($data);

        if($a){
            $b = MenuRole::saveMenuRole($a->user_id,$menu_ids);

            if($b){
                return $this->success();
            }
        }
        return $this->fail(200004);
    }

    public function edit($role_id){

        $role = Role::getRoleById($role_id);
        $menus  = Session::get('menus');
        $menu_ids = MenuRole::getMenuId($role->id);

        return view('role/edit',['role'=>$role,'menus'=>$menus,'menu_ids'=>$menu_ids]);
    }

    public function update($role_id){
        $data = Input::all();
        $menu_ids = $data['menu_ids'];
        unset($data['menu_ids']);
        $a = User::where('role_id',$role_id)->update($data);
        if($a){
            //保存用户角色和菜单权限
            $b = MenuRole::where('user_id',$a->user_id)->delete();
            if($b){
                $this->success();
            }
        }
        $this->fail(200005);
    }

    public function destroy($role_id){
        $a = Role::where('id',$role_id)->update(['is_del'=>'1']);
        if($a){
            $this->success();
        }else{
            $this->fail(200006);
        }
    }

}