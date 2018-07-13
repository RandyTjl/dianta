<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'role';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'is_del'
    ];

    public static function getRoleById($role_id){
        $role = self::find($role_id);
        return $role;
    }

}
