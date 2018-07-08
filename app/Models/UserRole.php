<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'user_role';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'role_id',
    ];

    public static function getRoleId($user_id){
        $role = self::where("user_id",$user_id)->get(['role_id'])->toArray();
        $role =  array_field($role);
        return $role[ 'role_id'];
    }

    public static function getUserId($role_id){
        $user = self::where("role_id",$role_id)->get(['user_id'])->toArray();
        $user = array_field($user);
        return $user['user_id'];
    }

}
