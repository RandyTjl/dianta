@extends('layouts.body')

@section('title',"角色添加");
@section('name',"url");

@section('content')
    <link rel="stylesheet" href="/plugins/iCheck/all.css">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">角色信息</h3>
        </div>
        <input type="text" style="display: none" id="role_id"  value="">
        <form role="form">
            <div class="card-body">
                <div class="form-group">
                    <label for="email">角色名</label>
                    <input type="email"  name="name" class="form-control" id="name" placeholder="角色名" value="">
                </div>
                <div class="form-group">
                    <label for="password">状态</label>
                    <input type="type" name="status" class="form-control" id="status" placeholder="密码" value="">
                </div>
                <div class="form-group">
                    <label for="role">角色权限</label>
                    <div class="form-group">
                        <?php
                            echo power_check();
                        ?>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" class="btn btn-primary" id="save">保存</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="/plugins/iCheck/icheck.min.js"></script>
    <script>
        $().ready(function () {
            $("#save").on('click',function () {
                var data = $("form").serialize();
                var url = '/roles';
                $.ajax({
                    'type':'POST',
                    'data':data,
                    'url':url,
                    beforeSend:function () {
                        load_html(1);
                    },
                    success:function (msg) {
                        close_load_html();
                        if(msg.code == 200){
                            window.history.go(-1);
                        }else{
                            alert(msg.message);
                        }
                    },
                    error:function (err) {
                        close_load_html();
                        alert("网络连接错误");
                    }

                })
            })
        })

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        })

    </script>
@endsection

