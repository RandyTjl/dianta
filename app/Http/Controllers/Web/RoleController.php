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

class RoleController extends BaseController{

    public function index(){
        $roles = Role::where('is_del','<>','1')->paginate(1);
        return view("role/index",['roles'=>$roles]);
    }

    public function create(){

    }

    public function edit($role_id){

        $role = Role::getRoleById($role_id);
        $menus  = Session::get('menus');
        $menu_ids = MenuRole::getMenuId($role->id);

        return view('role/edit',['role'=>$role,'menus'=>$menus,'menu_ids'=>$menu_ids]);
    }

    public function update($user_id){
        $data = Input::all();
        $a = User::where('id',$user_id)->update($data);
        if($a){
            $this->success();
        }else{
            $this->fail(200005);
        }
    }

    public function destroy($user_id){
        $a = User::where('id',$user_id)->update(['is_del'=>'1']);
        if($a){
            $this->success();
        }else{
            $this->fail(200006);
        }
    }

}