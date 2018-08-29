@extends('layouts.body')

@section('title',"菜单管理")
@section('name',"菜单")

@section('content')
    <div class="row">
        <div class="col-md-5">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" id="menu">
                        <?php
                            echo  $menu_list;
                        ?>
                    </ul>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <!-- /.col -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item" id="edit" ><a class="nav-link active" href="#activity" data-toggle="tab">修改</a></li>
                        <li class="nav-item" id="add" ><a class="nav-link" href="#timeline" data-toggle="tab">添加</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">菜单列表</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form role="form" id="menu_form">
                                    <input id="id" value="" style="display: none" name="id" >
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>菜单名称</label>
                                        <input type="text" class="form-control" placeholder="请输入菜单名称" name="menu_name">
                                    </div>
                                    <div class="form-group">
                                        <label>菜单链接</label>
                                        <input type="text" class="form-control" placeholder="请输入url地址" name="url">
                                    </div>


                                    <div class="form-group">
                                        <label>父级目录</label>
                                        <select class="form-control" name="parent_id">
                                            <option value="">请选择</option>
                                            @foreach($menuAll as $m)
                                            <option value="{{$m['id']}}">{{$m['menu_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>icon</label>
                                        <input type="text" class="form-control" placeholder="Enter ..." name="icon">
                                    </div>
                                    <div class="form-group">
                                        <label>状态</label>
                                        <select class="form-control" name="is_del">
                                            <option value="">启用</option>
                                            <option value="">禁用</option>
                                        </select>
                                    </div>
                                    <div class="group">
                                        <button type="button" class="btn btn-primary" id="save">提交</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>


@endsection

@section('script')
<script>
    $(function () {

        $("#menu").find('a').on('click',function () {
            $("#menu").find('a').css('background-color','');
            $("#menu").find('a').removeClass('ac');
            $(this).css("background-color","#ddd");
            $(this).addClass('ac');
            edit_show($(this).attr("menu_id"));
        })

        $("#edit").click(function () {
            edit_show();
        });

        $("#add").click(function () {
            add_list();
        });

        $("#save").click(function () {
            var data = $("#menu_form").serialize();
            var type = '';
            var url = '';
            if($("#edit").find("a").hasClass("active")){
                 url = "/menus/"+$("#id").val();
                 type = "PUT";
            }else{
                url = "/menus"
                type = "POST";
            }
            $.ajax({
                'type':type,
                'data':data,
                'url':url,
                success:function (msg) {
                    if(msg.code == 200){
                        window.location.reload();
                    }else{
                        alert("操作失敗")
                    }
                },
                error:function (err) {
                    alert("网络连接错误");
                }
            })
        })
    })
    function edit_show(menu_id) {
        if(menu_id == undefined || menu_id == ''){
            menu_id = $("a.ac").attr('menu_id');
        }
        var url = "/menus/"+menu_id;
        $.ajax({
            'type':"GET",
            'url':url,
            success:function (msg) {
                if(msg.code == 200){
                    var list = msg.data;
                    $("input[name='id']").val(list.id);
                    $("input[name='menu_name']").val(list.menu_name);
                    $("input[name='url']").val(list.url);
                    $("select[name='parent_id']").val(list.parent_id);
                    $("input[name='icon']").val(list.icon);
                    $("select[name='is_del']").val(list.is_del);
                }else{
                    alert("获取信息失败");
                }
            }
        })
    }

    function add_list() {
        $("#menu_form").find("input,select").val('');
    }
</script>

@endsection

