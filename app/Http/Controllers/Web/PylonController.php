<?php
/**
 * Created by PhpStorm.
 * User: Randy
 * Date: 2018/7/11
 * Time: 17:22
 */
namespace App\Http\Controllers\Web;

use App\Models\Pylon;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use App\Models\Role;
use Illuminate\Support\Facades\Session;
use App\Models\MenuRole;
use Illuminate\Support\Facades\Hash;

class PylonController extends BaseController{

    public function index(){
        $pylons = Pylon::paginate(1);
        return view("pylon/index",['datas'=>$pylons]);

    }

    public function create(){
        return view('pylon/create');
    }

    public function store(){
        $data = Input::all();

        $a = Pylon::create($data);

        if($a){

            return $this->success();

        }
        return $this->fail(200004);
    }

    public function edit($pylon_id){

        $pylon = Pylon::getRoleById($pylon_id);

        return view('pylon/edit',['pylon'=>$pylon]);
    }

    public function update($pylon_id){
        $data = Input::all();

        $a = Pylon::where('id',$pylon_id)->update($data);
        if($a){
            $this->success();

        }
        $this->fail(200005);
    }

    public function destroy($pylon_id){
        $a = Role::where('id',$pylon_id)->update(['is_del'=>'1']);
        if($a){
            $this->success();
        }else{
            $this->fail(200006);
        }
    }

}