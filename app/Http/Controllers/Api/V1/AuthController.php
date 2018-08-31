<?php
/**
 * Created by PhpStorm.
 * User: Randy
 * Date: 2018/8/17
 * Time: 17:24
 */

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller{



    protected function success($data = [])
    {
        return response()->json([
            'status'  => true,
            'code'    => 200,
            'message' => config('apicode.code')[200],
            'data'    => $data,
        ]);
    }

    protected function fail($code, $data = [])
    {
        return response()->json([
            'status'  => false,
            'code'    => $code,
            'message' => config('apicode.code')[(int) $code],
            'data'    => $data,
        ]);
    }

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
			$data['user'] = $user;
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
	
	public function verifyApiToken(Request $request){
		$apiToken = $request->input('apiToken');
        $user = User::where('api_token',$apiToken)->first();
        if(empty($user) || $user->token_expiration > time()){
            return response()->json(['status'  => true, 'code'    => 300001, 'message' => config('apicode.code')[(int) 300001],]);
        }
        
		return response()->json(['status'  => true, 'code'    => 200, 'message' => config('apicode.code')[(int) 200],'data'=>$user]);
	}


}