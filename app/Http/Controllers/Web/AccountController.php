<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/7/8
 * Time: 19:14
 */

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Support\Facades\Session;

class AccountController extends BaseController
{

    public function index(){
        $user_id = Session::get('user_id');
        $user = User::getUserById($user_id);
        return view('account/index',['user'=>$user]);
    }

}