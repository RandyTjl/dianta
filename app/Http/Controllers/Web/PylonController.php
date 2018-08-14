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
use App\Models\PylonStructure;
use DB;

class PylonController extends BaseController{

    public function index(){
        $pylons = Pylon::paginate(15);
        return view("pylon/index",['datas'=>$pylons]);

    }

    public function create(){
        return view('pylon/create');
    }

    public function store(){
        $data = Input::all();
        $tabula_list = json_decode($data['tabula_list'])?json_decode($data['tabula_list']): '';
        $bottom_list =json_decode($data['tabula_list'])?json_decode($data['tabula_list']): '';
        $body_list =json_decode($data['body_list'])?json_decode($data['body_list']):'';
        $head_list =json_decode($data['head_list'])?json_decode($data['head_list']):'';
        $head_other_list =json_decode($data['head_other_list'])?json_decode($data['head_other_list']):'';

        $data['user_id'] = Session::get('user_id');
        DB::beginTransaction();

        $a = Pylon::create($data);

        if($a){

            $tabula_list = $this->jsonToArray($tabula_list,$a->id);

            //横隔
            if($tabula_list){
                foreach ($tabula_list as $tabula){
                   $b =  PylonStructure::create($tabula);
                   if(!$b){
                       DB::rollBack();
                       return $this->fail(200004);
                   }
                }
            }
            //塔底
            $bottom_list = $this->jsonToArray($bottom_list,$a->id);
            if($bottom_list){
                foreach ($bottom_list as $bottom){
                    $b = PylonStructure::create($bottom);
                    if(!$b){
                        DB::rollBack();
                        return $this->fail(200004);
                    }
                }
            }

            //塔身
            $body_list = $this->jsonToArray($body_list,$a->id);
            if($body_list){
                foreach ($body_list as $body){
                    $b = PylonStructure::create($body);
                    if(!$b){
                        DB::rollBack();
                        return $this->fail(200004);
                    }
                }
            }

            //塔头
            $head_list = $this->jsonToArray($head_list,$a->id);
            if($head_list){
                foreach ($head_list as $head){
                    $b = PylonStructure::create($head);
                    if(!$b){
                        DB::rollBack();
                        return $this->fail(200004);
                    }
                }
            }
            //塔头组件
            $head_other_list = $this->jsonToArray($head_other_list,$a->id);
            if($head_other_list){
                foreach ($head_other_list as $head_other){
                    $b = PylonStructure::create($head_other);
                    if(!$b){
                        DB::rollBack();
                        return $this->fail(200004);
                    }
                }
            }
            DB::commit();
            return $this->success();

        }
        return $this->fail(200004);
    }

    public function edit($pylon_id){

        $pylon = Pylon::getPylon($pylon_id);

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

    private function jsonToArray($datas,$pylon_id){
        $return = [];
        foreach ($datas as $k=>$data){
            $return[$k]['pylon_id'] = $pylon_id;
            $return[$k]['name'] = empty($data->name)?'':$data->name;
            $return[$k]['type'] = empty($data->type)?'':$data->type;
            $return[$k]['part_type'] = empty($data->part_type)?'':$data->part_type;
            $return[$k]['height'] = empty($data->height)?'':$data->height;
            $return[$k]['n'] = empty($data->n)?0:$data->n;
            $return[$k]['vertices'] = empty($data->vertices)?'':"'".json_encode($data->vertices)."'";
            $return[$k]['faces'] = empty($data->faces)?'':"'".json_encode($data->faces)."'";
            $return[$k]['direction'] = empty($data->direction)?'':$data->direction;
            $return[$k]['head_l1'] = empty($data->head_l1)?'':$data->head_l1;
            $return[$k]['head_l2'] = empty($data->head_l2)?'':$data->head_l2;
            $return[$k]['parent_id'] = empty($data->parent_id)?0:$data->parent_id;
            $return[$k]['h_p'] = empty($data->h_p)?'':$data->h_p;
        }
        return $return;
    }

}