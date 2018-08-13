@extends('layouts.body')

@section('title',"信息修改");
@section('name',"url");

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">详细信息</h3>
        </div>
        <form role="form">
            <div class="card-body">
                <div class="form-group col-sm-12 hidden" >
                    <label for="pylon_id">电塔id</label>
                    <input type="text"  name="pylon_id" class="form-control" id="pylon_id" placeholder="电塔id" value="">
                </div>
                <div class="form-group col-sm-12" >
                    <label for="name">电塔名称</label>
                    <input type="text"  name="name" class="form-control" id="name" placeholder="电塔名称" value="">
                </div>
                <div class="form-group col-sm-12">
                    <label for="site">电塔地址</label>
                    <input type="text" name="site" class="form-control" id="site" placeholder="电塔地址" value="">
                </div>
                <div class="form-group col-sm-6 pull-left" >
                    <label for="Longitude">经度</label>
                    <input type="text" name="Longitude" class="form-control" id="Longitude" placeholder="经度" value="">
                </div>
                <div class="form-group col-sm-6 pull-left">
                    <label for="latitude">纬度</label>
                    <input type="text" name="latitude" class="form-control" id="latitude" placeholder="纬度" value="">
                </div>
                <div class="form-group col-sm-6 pull-left">
                    <label for="length">底边长度</label>
                    <input type="text" name="length" class="form-control" id="length" placeholder="底边长度" value="40">
                </div>
                <div class="form-group col-sm-6 pull-left">
                    <label for="width">底边宽度</label>
                    <input type="text" name="width" class="form-control" id="width" placeholder="底边宽度" value="40">
                </div>
                <div class="form-group col-sm-6 pull-left">
                    <label for="bottom_top">底部上边长度</label>
                    <input type="text" name="bottom_top" class="form-control" id="bottom_top" placeholder="底部上边长度" value="35">
                </div>
                <div class="form-group col-sm-6 pull-left">
                    <label for="radian">塔竖面倾斜度</label>
                    <input type="text" name="radian" class="form-control" id="radian" placeholder="倾斜弧度0.25 到 0.5之间" value="0.45">
                </div>
            </div>
            <hr  style="height:1px;border:none;border-top:1px dashed #1c7430;" >
            <div class=" col-sm-6 pull-left" id="pylon_condition" style="margin: 15px 0" >
                <div id="pylon_tabula" >
                    <label >横隔:</label>
                    <div class="card-body" style="border: #00a65a 1px solid;">
                        <div class="form-group col-sm-6 pull-left" >
                            <label for="tabula_type">模块类型</label>
                            <select class="form-control" name="tabula_type" id="tabula_type">
                                <option>请选择</option>
                                <option value="1" selected>模型1</option>
                                <option value="2"  >模型2</option>
                                <option value="3">模型3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="pylon_bottom" name="structure" >
                    <input type="text" style="display: none" value="1" name="pylon_type">
                    <label >塔底:</label>
                    <div class="card-body" style="border: #00a65a 1px solid;">
                        <div class="form-group col-sm-6 pull-left" >
                            <label for="height">垂直高度</label>
                            <input type="text" name="height" class="form-control"  placeholder="垂直高度" value="40">
                        </div>
                        <div class="form-group col-sm-6 pull-left" >
                            <label for="n">分段数</label>
                            <input type="text" name="n" class="form-control"  placeholder="底部有几个条纹" value="2">
                        </div>
                    </div>
                </div>
                <div style="margin-top: 20px" id="pylon_body"  name="add_html" >
                    <label >塔身:</label>
                    <div class="pull-right">
                        <button class="btn btn-primary" type="button" onclick="add_html(this)">添加</button>
                    </div>
                    <div style="border: #00a65a 1px solid;margin-top: 10px"  name="data_list">
                        <div class="card-body" name="structure" id="pylon_body1" >
                            <input type="text" style="display: none" value="2" name="pylon_type">
                            <div  class="col-sm-12" >
                                <p name="name_list">组成1</p>
                                <i class="fa fa-close" style="color: red;font-size: 22px;position: absolute;right: 10px;top:2px" onclick="remove_html(this)"></i>
                            </div>

                            <div class="form-group col-sm-6 pull-left" >
                                <label for="height">垂直高度</label>
                                <input type="text" name="height" class="form-control"  placeholder="垂直高度" value="40">
                            </div>
                            <div class="form-group col-sm-6 pull-left" >
                                <label for="n">分段数</label>
                                <input type="text" name="n" class="form-control"  placeholder="底部有几个条纹" value="2">
                            </div>
                            <div class="form-group col-sm-6 pull-left" >
                                <label for="part_type">模块类型</label>
                                <select class="form-control" name="part_type" >
                                    <option>请选择</option>
                                    <option value="1" selected >模型1</option>
                                    <option value="2">模型2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="pylon_head"  style="margin-top: 10px"  name="add_html">
                    <label >塔头:</label>
                    <div class="pull-right">
                        <button class="btn btn-primary" type="button" onclick="add_html(this)" >添加</button>
                    </div>
                    <div style="border: #00a65a 1px solid;margin-top: 10px" name="data_list">
                        <div class="card-body"  name="structure" id="pylon_head1">
                            <input type="text" style="display: none" value="3" name="pylon_type">
                            <div  class="col-sm-12" >
                                <p name="name_list">组成1</p>
                                <i class="fa fa-close" style="color: red;font-size: 22px;position: absolute;right: 10px;top:2px" onclick="remove_html(this)"></i>
                            </div>
                            <div class="form-group col-sm-6 pull-left" >
                                <label for="position">塔身位置</label>
                                <input type="text" name="position" class="form-control"  placeholder="塔头所在的位置,填写塔身编号" value="1">
                            </div>

                            <div class="form-group col-sm-6 pull-left" >
                                <label for="head_l1">底边长度</label>
                                <input type="text" name="head_l1" class="form-control"  placeholder="底边长度" value="30">
                            </div>
                            <div class="form-group col-sm-6 pull-left" >
                                <label for="part_type">类型</label>
                                <select class="form-control" name="part_type" >
                                    <option>请选择</option>
                                    <option value="1" selected >类型1</option>
                                    <option value="2">类型2</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6 pull-left" >
                                <label for="n">分段数</label>
                                <input type="text" name="n" class="form-control"  placeholder="条纹分段" value="2">
                            </div>
                            <div class="form-group col-sm-6 pull-left" >
                                <label for="direction">头部方向</label>
                                <select class="form-control" name="direction" >
                                    <option>请选择</option>
                                    <option value="x" selected >x轴方向</option>
                                    <option value="y">y轴方向</option>
                                    <option value="z">z轴方向</option>
                                    <option value="-x">-x轴方向</option>
                                    <option value="-y">-y轴方向</option>
                                    <option value="-z">-z轴方向</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6 pull-left" >
                                <label for="module_l1">头部组件低边1长</label>
                                <input type="text" name="module_l1" class="form-control"  placeholder="头部组件低边1长" value="10">
                            </div>
                            <div class="form-group col-sm-6 pull-left" >
                                <label for="module_l2">头部组件低边2长</label>
                                <input type="text" name="module_l2" class="form-control"  placeholder="底边2的长度大于底边1" value="20">
                            </div>
                            <div class="form-group col-sm-6 pull-left" >
                                <label for="module_type">组件类型</label>
                                <select class="form-control" name="module_type" >
                                    <option>请选择</option>
                                    <option value="1" selected >类型1</option>
                                    <option value="2">类型2</option>
                                    <option value="3">类型3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 pull-left" >
                <button class="btn btn-primary" type="button" id="show">展示</button>
                <button class="btn btn-primary" type="button" id="close">关闭</button>
                <div id="canvas-frame"></div>
            </div>
            <div style="clear: both"></div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" class="btn btn-primary" id="save">保存</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="/js/three.min.js"></script>
    <script src="/js/pylon.js"></script>
    <script src="/js/admin/createPylon.js"></script>
    <script>

        $().ready(function () {
            //初始化电塔图标
            threeStart("canvas-frame");

            $("#save").on('click',function () {
                var data = $("form").serialize();
                var url = '/pylons';
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
            $("#show").click(function () {
                $("#canvas-frame").find("canvas").remove();
                threeStart("canvas-frame");
            })
            $("#close").click(function () {
                $("#canvas-frame").find("canvas").remove();
            })
        })

        //添加html
        function add_html(obj) {
            var obj_list = $(obj).parents("div[name='add_html']");
            var html = obj_list.find("div[name='data_list']").find("div.card-body:first").clone();
            obj_list.find("div[name='data_list']").append(html);

            order_list(obj_list);
        }

        function remove_html(obj) {
            var obj_list = $(obj).parents("div[name='add_html']");
            $(obj).parents("div.card-body").remove();
            order_list(obj_list);
        }

        //排序
        function order_list(obj_list) {
            var id = obj_list.attr("id");
            var list = 0;
            obj_list.find("div.card-body").each(function (i,value) {
                list = i+1;

                $(value).attr("id",id+list);
                $(value).find("p[name='name_list']").html("组成"+list);
            })
        }

    </script>
@endsection

