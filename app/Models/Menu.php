<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'menu';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu', 'menu_name','parent_id','url','icon','is_del'
    ];

    /**
     * 获得菜单
     * @param $menu_ids 菜单id组
     * @return mixed
     */
    public static function getMenu($menu_ids){
        $menus = self::whereIn("id",$menu_ids)->get()->toArray();
        return $menus;
    }

    /**
     * 获得所有的菜单
     * @return array
     */
    public static function getAllMenu(){
        $menus = self::all()->toArray();
        return $menus;
    }


}
