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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

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
        $a = User::where('id',$user_id)->update(['api_token'=>'']);
        if($a){
            return $this->success();
        }else{
            return $this->fail("200007");
        }
    }
	
	public function verifyApiToken(Request $request){
		$apiToken = $request->input('apiToken');
        $user = User::where('api_token',$apiToken)->first();

        if(empty($user) || $user->token_expiration < time()){
            return response()->json(['status'  => true, 'code'    => 300002, 'message' => config('apicode.code')[(int) 300002],]);
        }
        
		return response()->json(['status'  => true, 'code'    => 200, 'message' => config('apicode.code')[(int) 200],'data'=>$user]);
	}

	public function updatePwd(){
        $email = Input::get('email');
        $oldPwd = Input::get('oldPwd');
        $newPwd = Input::get('newPwd');
        $newPwd1 = Input::get('newPwd1');
        $user = User::where(['email' => $email])->first();
        if($newPwd != $newPwd1){
            return $this->fail(200011);
        }
        if($user && Hash::check($oldPwd,$user->password)){
            $password = Hash::make($newPwd);
            User::where('email',$email)->update(['password'=>$password]);
            return $this->success();
        }else{
            return $this->fail(200008);
        }
    }

    /**
     * 获得忘记密码的验证码
     * @return \Illuminate\Http\JsonResponse
     */
    public function getForgetCode(){
        $email = Input::get('email');
        $data = [
            'to' => $email,
            'subject' => "邮箱验证码",
        ];
        $code = getCode(4,2);

        $msg = "您的验证码是".$code.',5分钟后过期';

        Mail::raw($msg, function ($message) use ($data) {
            $message ->to($data['to'])->subject($data['subject']);
        });
        if(count(Mail::failures()) < 1){
            Redis::setex( $email , 300 , $code );
            return $this->success();
        }else{
            return $this->fail(200012);
        }
    }

    /**
     *忘记密码更新密码
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgetPwdUpdate(){
        $email = Input::get('email');
        $password = Input::get('password');
        $code = Input::get('code');
        if($code != Redis::get($email)){
            return $this->fail(200013);
        }

        $password = Hash::make($password);
        $a = User::where('email',$email)->update(['password'=>$password]);
        if(!$a){
            return $this->fail('200005');
        }

        return $this->success();
    }

}