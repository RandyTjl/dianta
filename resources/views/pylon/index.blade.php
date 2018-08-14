@extends('layouts.body')

@section('title',"电塔信息");
@section('name',"url");

@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">电塔</h3>
            </div>
            <div class="card-body">
                <button type="button" class="btn  btn-default pull-right" id="add">添加电塔</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="user_info" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="width: 10%">电塔id</th>
                        <th style="width: 20%">电塔名称</th>
                        <th style="width: 20%">创建者</th>
                        <th style="width: 20%">地址</th>
                        <th style="width: 10%">倾斜度</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $k=>$pylon)
                    <tr>
                        <td>{{$pylon->id}}</td>
                        <td>{{$pylon->name}}</td>
                        <td>{{$pylon->user_id}}</td>
                        <td>{{$pylon->site}}</td>
                        <td>{{$pylon->radian}}</td>
                        <td>
                            <button type="button" class="btn btn-btn-app btn-primary " onclick="pylon_edit(this)"><i class="fa fa-edit">修改</i></button>
                            <button type="button" class="btn btn-btn-app btn-danger" onclick="pylon_delete(this)"><i class="fa fa-trash-o">删除</i></button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $datas->links() }}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function () {
            $("#add").on('click',function () {
                var url = "pylons/create";
                window.location.href = url;
            })

        })
        function pylon_edit(obj) {
            var url = "/pylons/" +$(obj).parents('tr').find('td').first().text()+ "/edit";
            window.location.href = url;
        }
        
        function pylon_delete(obj) {
            var url = "/pylons/"+$(obj).parents('tr').find('td').first().text();
            $.ajax({
                type:"DELETE",
                url:url,
                success:function (msg) {
                    if(msg.code == 200){
                        alert("删除成功");
                        window.location.reload();
                    }else{
                        alert(msg.message);
                    }
                }
            })
        }
    </script>
@endsection