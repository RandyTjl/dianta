<?php
/**
 * Created by PhpStorm.
 * User: Randy
 * Date: 2018/7/11
 * Time: 17:22
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends BaseController{

    public function show($user_id){
        $user = User::find($user_id);
        if(!$user){
            return $this->fail(200008);
        }else{
            return $this->success($user);
        }

    }


    public function update($user_id){
        $data = Input::all();

        $a = User::where('id',$user_id)->update($data);
        if($a){
            return $this->success();
        }
        return $this->fail(200005);
    }

    /**
     * 重置密码
     * @return \Illuminate\Http\JsonResponse
     */
   public function resetPwd(){
        $email = Session::get('email');
        if(empty($email)){
            return $this->fail(200001);
        }
        $password = Input::get('password');
        $user = User::where('email',$email)->first();
        if(!Hash::ckeck($password,$user->password)){
            $data['password'] = Hash::make($password);
            $a = User::where('id',$user->id)->update($data);
            if($a){
                return $this->success();
            }
            return $this->fail(200005);
        }
   }

   public function changePwd(){
        $user_id = $this->user_id;
        $password = Input::get('password');
        $newPassword = Input::get('newPassword');
        if($password == $newPassword){
            return $this->fail(200009);
        }
        $newPassword = Hash::make($newPassword);
        $a = User::where('id',$user_id)->update(['password'=>$newPassword]);
        if(!$a){
            return $this->fail(200005);
        }
        return $this->success();
   }

}