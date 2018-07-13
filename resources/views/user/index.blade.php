@extends('layouts.body')

@section('title',"用户信息");
@section('name',"url");

@section('content')
    <!-- DataTables -->
    {{--<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap4.min.css">--}}
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">用户</h3>
            </div>
            <div class="card-body">
                <button type="button" class="btn  btn-default pull-right" id="add">添加用户</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="user_info" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="width: 10%">用户id</th>
                        <th style="width: 10%">昵称</th>
                        <th style="width: 15%">Email</th>
                        <th style="width: 20%">image</th>
                        <th style="width: 10%">启用</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $k=>$user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->iamge}}</td>
                        <td>{{$user->is_del}}</td>
                        <td>
                            <button type="button" class="btn btn-btn-app btn-primary " id="edit"><i class="fa fa-edit">修改</i></button>
                            <button type="button" class="btn btn-btn-app btn-danger" id="delete"><i class="fa fa-trash-o">删除</i></button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function () {
            $("#edit").on('click',function () {
                var url = "/users/" +$(this).parents('tr').find('td').first().html() + "/edit";
                window.location.href = url;
            })

            $("#delete").on('click',function () {
                var url = "/users/"+$(this).parents('tr').find('td').first().html();
                $.ajax({
                    type:"DELETE",
                    url:url,
                    beforeSend:function () {
                        load_html(1);
                    },
                    success:function (msg) {
                        close_load_html();
                        if(msg.code == 200){
                            alert("删除成功");
                            window.location.reload();
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
    </script>
    <!-- DataTables -->
    {{--<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables/dataTables.bootstrap4.min.js"></script>--}}
   {{-- <script>
        $(function () {
            $('#user_info').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>--}}
@endsection