@extends('layouts.body')

@section('title',"信息修改");
@section('name',"url");

@section('content')
    <link rel="stylesheet" href="/plugins/iCheck/all.css">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">详细信息</h3>
        </div>
        <input type="text" style="display: none" id="user_id"  value="{{$user->id}}">
        <form role="form">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">电塔名称</label>
                    <input type="text"  name="name" class="form-control" id="name" placeholder="电塔名称" value="{{$pylon->name}}">
                </div>
                <div class="form-group">
                    <label for="site">电塔地址</label>
                    <input type="text" name="site" class="form-control" id="site" placeholder="电塔地址" value="{{$pylon->site}}">
                </div>
                <div class="form-group col-sm-6">
                    <label for="Longitude">经度</label>
                    <input type="text" name="Longitude" class="form-control" id="Longitude" placeholder="经度" value="{{$pylon->Longitude}}">
                </div>
                <div class="form-group col-sm-6">
                    <label for="latitude">纬度</label>
                    <input type="text" name="latitude" class="form-control" id="latitude" placeholder="纬度" value="{{$pylon->latitude}}">
                </div>
                <div class="form-group col-sm-6">
                    <label for="length">底边长度</label>
                    <input type="text" name="length" class="form-control" id="length" placeholder="底边长度" value="{{$pylon->length}}">
                </div>
                <div class="form-group col-sm-6">
                    <label for="width">底边宽度</label>
                    <input type="text" name="width" class="form-control" id="width" placeholder="底边宽度" value="{{$pylon->width}}">
                </div>
                <div class="form-group col-sm-6">
                    <label for="bottom_top">底部上边长度</label>
                    <input type="text" name="bottom_top" class="form-control" id="bottom_top" placeholder="底部上边长度" value="{{$pylon->bottom_top}}">
                </div>
                <div class="form-group col-sm-6">
                    <label for="radian">塔竖面倾斜度</label>
                    <input type="text" name="radian" class="form-control" id="radian" placeholder="倾斜弧度PI/4 到 PI/2" value="{{$pylon->radian}}">
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
                var url = '/users/'+$("#user_id").val();
                $.ajax({
                    'type':'PUT',
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

