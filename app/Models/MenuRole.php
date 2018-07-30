<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuRole extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'menu_role';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_id', 'role_id',
    ];

    /**
     * 获得菜单id组
     * @param $role_ids
     * @return mixed
     */
    public static function getMenuId($roleids){
        $role_ids = [];
        if(!is_array($roleids)){
            $role_ids[] = $roleids;
        }else{
            $role_ids = $roleids;
        }

        $menu_ids = self::whereIn("role_id",$role_ids)->get(['menu_id'])->toArray();
        $menu_ids = array_field($menu_ids)['menu_id'];
        return $menu_ids;
    }

    public static function saveMenuRole($role_id,$menu_ids){
        $input['role_id'] = $role_id;
        if($menu_ids && is_array($menu_ids)){
            foreach ($menu_ids as $menu_id){
                $input['menu_id']   = $menu_id;
                $a = self::create($input);
                if(!$a){
                    return false;
                }
            }
        }
        return true;
    }


}
