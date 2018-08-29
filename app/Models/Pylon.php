<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pylon extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'pylon';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name','site','Longitude','latitude','type','length','width','bottom_top','radian','is_del'
    ];


    /**
     * 获得电塔
     * @param $menu_ids 菜单id组
     * @return mixed
     */
    public static function getPylon($pylon_id){
        $pylon = self::where("id",$pylon_id)->first();
        return $pylon;
    }


}
