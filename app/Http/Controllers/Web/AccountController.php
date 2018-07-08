<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/7/8
 * Time: 19:14
 */

namespace App\Http\Controllers\Web;

class AccountController extends BaseController
{

    public function index(){
        return view('index/index');
    }

}