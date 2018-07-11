<?php
/**
 * Created by PhpStorm.
 * User: Randy
 * Date: 2018/7/11
 * Time: 17:22
 */
namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Support\Facades\Session;

class PowerController extends BaseController{

    public function index(){
        $menus  = Session::get('menus');
        return view("power/index",['menus'=>$menus]);
    }

}