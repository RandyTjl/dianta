<?php
/**
 * Created by PhpStorm.
 * User: Randy
 * Date: 2018/8/17
 * Time: 17:24
 */

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController{

    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where(['email' => $email])->first();
        if($user && Hash::check($password,$user->password)){
   /*     if(Auth::guard('api')->attempt(['email' => $email, 'password' => $password])){*/
            $token_expiration = strtotime("+7 day");
            $token = md5($email.time());
            User::where('email',$email)->update(['token_expiration'=>$token_expiration,'api_token'=>$token]);
            $data['api_token'] = $token;
            return $this->success($data);
        }else{
            return $this->fail("200002");
        }
    }

    public function logout(Request $request){
        $user_id = $request->input('user_id');
        $a = User::where('id',$user_id)->update(['token'=>'']);
        if($a){
            return $this->success();
        }else{
            return $this->fail("200007");
        }
    }



}