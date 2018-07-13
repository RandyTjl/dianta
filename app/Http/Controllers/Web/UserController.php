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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController{

    public function index(){
        $users = User::paginate(1);

        return view("user/index",['users'=>$users]);
    }

    public function edit($user_id){
        $user = User::getUserById($user_id);
        return view('user/edit',['user'=>$user]);
    }

    public function update($user_id){
        $data = Input::all();
        $user = Auth::user();
        $password = $user->password;
        if($data['password'] == $password){
            unset($data['password']);
        }else{
            $data['password'] = Hash::make($data['password']);
        }
        $a = User::where('id',$user_id)->update($data);
        if($a){
            return $this->success();
        }else{
            return $this->fail(200005);
        }
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