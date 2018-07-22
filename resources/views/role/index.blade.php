@extends('layouts.body')

@section('title',"角色信息");
@section('name',"url");

@section('content')
    <!-- DataTables -->
    {{--<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap4.min.css">--}}
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">角色</h3>
            </div>
            <div class="card-body">
                <button type="button" class="btn  btn-default pull-right" id="add">添加角色</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="user_info" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="width: 10%">角色id</th>
                        <th style="width: 20%">角色名</th>
                        <th style="width: 20%">状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $k=>$role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td>{{$role->is_del}}</td>
                        <td>
                            <button type="button" class="btn btn-btn-app btn-primary " id="edit"><i class="fa fa-edit">修改</i></button>
                            <button type="button" class="btn btn-btn-app btn-danger" id="delete"><i class="fa fa-trash-o">删除</i></button>
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
            $("#edit").on('click',function () {
                var url = "/roles/" +$(this).parents('tr').find('td').first() + "/edit";
                window.location.href = url;
            })

            $("#delete").on('click',function () {
                var url = "/roles/"+$(this).parents('tr').find('td').first();
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