<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PylonStructure extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'pylon_structure';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pylon_id', 'name','type','part_type','height','n','vertices','faces','direction','head_l1','head_l2','parent_id','h_p'
    ];

}
