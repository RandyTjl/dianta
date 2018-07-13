<?php
/**
 * Created by PhpStorm.
 * User: Randy
 * Date: 2018/7/11
 * Time: 17:22
 */
namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController{

    public function index(){
        $users = User::paginate(1);

        return view("user/index",['users'=>$users]);
    }

    public function create(){
        return view('user/create');
    }

    public function store(){
        $data = Input::all();
        $role_ids = Input::get('roles');
        unset($data['roles']);

        $data['password'] = Hash::make($data['password']);

        $a = User::create($data);

        if($a){
            UserRole::where('user_id',$a->user_id)->delete();
            $b = UserRole::saveRoleList($a->user_id,$role_ids);
            if($b){
                return $this->success();
            }
        }
        return $this->fail(200004);
    }

    public function edit($user_id){
        $user = User::getUserById($user_id);
        $role_ids = UserRole::getRoleId($user_id);
        return view('user/edit',['user'=>$user,'role_ids'=>$role_ids]);
    }

    public function update($user_id){
        $data = Input::all();
        $role_ids = Input::get('roles');
        unset($data['roles']);

        $user = Auth::user();
        $password = $user->password;
        if($data['password'] == $password){
            unset($data['password']);
        }else{
            $data['password'] = Hash::make($data['password']);
        }
        $a = User::where('id',$user_id)->update($data);
        if($a){
            UserRole::where('user_id',$user_id)->delete();
            $b = UserRole::saveRoleList($user_id,$role_ids);
            if($b){
                return $this->success();
            }

        }
        return $this->fail(200005);
    }

    public function destroy($user_id){
        $a = User::where('id',$user_id)->update(['is_del'=>'1']);
        if($a){
            return $this->success();
        }else{
            return $this->fail(200006);
        }
    }

}