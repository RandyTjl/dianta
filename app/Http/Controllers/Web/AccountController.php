<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/7/8
 * Time: 19:14
 */

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class AccountController extends BaseController
{

    public function index(){
        $user_id = Session::get('user_id');
        $user = User::getUserById($user_id);
        return view('account/index',['user'=>$user]);
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

}