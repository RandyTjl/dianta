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
    public static function getMenuId($role_ids){
        if(!is_array($role_ids)){
            $role_ids[] = $role_ids;
        }
        $menu_ids = self::whereIn("role_id",$role_ids)->get(['menu_id'])->toArray();
        $menu_ids = array_field($menu_ids)['menu_id'];
        return $menu_ids;
    }


}
