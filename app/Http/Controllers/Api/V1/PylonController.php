<?php
/**
 * Created by PhpStorm.
 * User: Randy
 * Date: 2018/7/11
 * Time: 17:22
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
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

    /**
     * 展示电塔列表数据
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $pylon = Pylon::where('is_del','<>','1')->paginate(10);
        if(empty($pylon)){
            return $this->fail(200010);
        }
        return $this->success($pylon);
    }

    /**
     * 展示单个电塔数据
     * @param $pylon_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($pylon_id){

        $pylon = Pylon::getPylon($pylon_id);
        $structures = PylonStructure::getStructureByPylonId($pylon_id);
        $datas = [];
        foreach ($structures as $k=>$structure){
            switch ($structure['type']){
                case 1:
                    $datas['bottom'] = $structure;
                    break;
                case 2:
                    $datas['body'][] = $structure;
                    break;
                case 3:
                    $datas['header'][] = $structure;
                    break;
                case 4:
                    $datas['header_other'][] = $structure;
                    break;
                case 5:
                    $datas['tabula'] = $structure;
                    break;
            }
        }

       return $this->success($datas);
    }


    /**
     * 软删除电塔数据
     * @param $pylon_id
     */
    public function destroy($pylon_id){
        $a = Role::where('id',$pylon_id)->update(['is_del'=>'1']);
        if($a){
            $this->success();
        }else{
            $this->fail(200006);
        }
    }



}