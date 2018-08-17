<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/7/7
 * Time: 17:30
 */

return [
   // web端返回错误码
    'code' => [
        200 => '成功',
        200001 => '缺少必要的参数',
        200002 => '账号或密码错误',
        200003 => '该账号已经注销，请联系管理员',
        200004 => '添加失败',
        200005 => '更新失败',
        200006 => '删除失败',

        //文章
        503001 => '上传文件的格式不正确',
        503002 => '同步成功-记录保存失败',
        503003 => '权限错误',
        503004 => '文章保存失败',
        403017 => '临近定时时间不能取消发送任务',
        403018 => '临近定时时间不能修改发送任务',
        403019 => '超过发送时间不能发送',
        403020 => '缺少发表记录ID参数',
        //SMS
        416001 => '添加成功,审核中,请耐心等待',
        416002 => '签名添加失败',
    ],


];