@extends('layouts.body')

@section('title',"角色添加");
@section('name',"url");

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">详细信息</h3>
        </div>
        <form role="form">
            <div class="card-body">
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
                <div style="margin-top: 20px" id="pylon_body"  >
                    <label >塔身:</label>
                    <div class="pull-right">
                        <button class="btn btn-primary" type="button">添加</button>
                    </div>
                    <div style="border: #00a65a 1px solid;margin-top: 10px"  >
                        <div class="card-body" name="structure" id="pylon_body1" >
                            <input type="text" style="display: none" value="2" name="pylon_type">
                            <div  class="col-sm-12" >
                                <p>组成1</p>
                                <i class="fa fa-close" style="color: red;font-size: 22px;position: absolute;right: 10px;top:2px"></i>
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
                <div id="pylon_head"  style="margin-top: 10px">
                    <label >塔头:</label>
                    <div class="pull-right">
                        <button class="btn btn-primary" type="button">添加</button>
                    </div>
                    <div class="card-body" style="border: #00a65a 1px solid;margin-top: 10px" name="structure" id="pylon_head1">
                        <input type="text" style="display: none" value="3" name="pylon_type">
                        <div  class="col-sm-12" >
                            <p>塔头1</p>
                            <i class="fa fa-close" style="color: red;font-size: 22px;position: absolute;right: 10px;top:2px"></i>
                        </div>
                        <div class="form-group col-sm-6 pull-left" >
                            <label for="position">塔身位置</label>
                            <input type="text" name="position" class="form-control"  placeholder="塔头所在的位置,填写塔身编号" value="1">
                        </div>
                        {{--<div class="form-group col-sm-6 pull-left" >
                            <label for="height">垂直高度</label>
                            <input type="text" name="height" class="form-control"  placeholder="垂直高度" value="40">
                        </div>--}}
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
            <div class="col-sm-6 pull-left" >
                <button class="btn btn-primary" type="button" id="show">展示</button>
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
    <script>
        $().ready(function () {
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
                threeStart();
            })
        })


        var t = 0;//旋转参数
        var renderer;
        var vertices = [];
        var faces = [];
        var mesh;
        var camera;
        var scene;
        var light;
        var l1 = '';    //底边长度
        var l2 = '';    //底边上边宽度
        var l3 = '';    //底边宽度
        var h = '';     //底边高度
        var radian = '' //平面倾角;
        var tabula_type = '';   //横隔类型

        //获取设置模型参数
        function setParameters() {
            $("#canvas-frame").height($("#canvas-frame").parent().prev().height());

            l1 = parseInt($('#length').val());
            l2 = parseInt($("#bottom_top").val());
            l3 = parseInt($("#width").val());
            radian = Math.PI*parseFloat($("#radian").val());
            tabula_type = parseInt($("#tabula_type").val());
        }

        //初始化画布
        function initThree() {
            width = document.getElementById('canvas-frame').clientWidth;
            height = document.getElementById('canvas-frame').clientHeight;
            renderer = new THREE.WebGLRenderer({
                antialias : true
            });
            renderer.setSize(width, height);
            document.getElementById('canvas-frame').appendChild(renderer.domElement);
            renderer.setClearColor(0xFFFFFF, 1.0);
        }

        //初始化相机
        function initCamera() {
            camera = new THREE.PerspectiveCamera(70, width / height, 1, 10000);
            //camera = new THREE.OrthographicCamera( window.innerWidth / - 2, window.innerWidth / 2, window.innerHeight / 2, window.innerHeight / - 2, 10, 1000  )
            camera.position.x = 200;
            camera.position.y = 200;
            camera.position.z = 200;
            camera.up.x = 0;
            camera.up.y = 1;
            camera.up.z = 0;
            camera.lookAt(0,0,0);
        }

        //初始化场景
        function initScene() {
            scene = new THREE.Scene();
        }

        //初始化灯光
        function initLight() {
            /* light = new THREE.AmbientLight(0xBEBEBE);
             light.position.set(100, 100, 200);
             scene.add(light);*/

            light = new THREE.DirectionalLight(0xFF0000,1);
            // 位置不同，方向光作用于物体的面也不同，看到的物体各个面的颜色也不一样
            light.position.set(1,0,0);
            scene.add(light);

            /*light = new THREE.PointLight(0x00FF00);
            light.position.set(300, 0,0);
            scene.add(light);*/
        }

        //初始化对象
        function initObject() {
            var ph_body =  new Array();
            //塔身高度
            var ph_height = new Array();
            //塔身前面总高度
            var ph_h_p = new Array();
            var ph = new Array();//结构调用返回的参数
            var h_p = 0;   //前面部分总高
            var head_ph = '';

            $("div[name='structure']").each(function (i,value) {
                //立方体
                var cubeGeometry = new THREE.Geometry();
                //材质
                var material = new THREE.MeshBasicMaterial({color:0x00ae00,wireframe : true,skinning:true});

                var pylon_type = Number($(value).find("input[name='pylon_type']").val());
                var height = parseInt($(value).find("input[name='height']").val());
                var n = parseInt($(value).find("input[name='n']").val());
                var part_type = parseInt($(value).find("select[name='part_type']").val());

                switch (pylon_type){
                    case 1:
                        ph = pylon_bottom(height,l1,l2,l3,n,radian);
                        //横隔
                        var plan = new THREE.PlaneGeometry();
                        var ta = tabula1(ph[2],tabula_type);
                        plan.vertices = ta[0];
                        plan.faces = ta[1];
                        mesh1 = new THREE.Mesh( plan,material );
                        scene.add( mesh1 );
                        break;
                    case 2:
                        ph = pylon_body(l1,ph[2],h_p,height,n,radian,part_type);
                        //保存塔身的值
                        ph_body.push(ph);
                        ph_height.push(height);
                        ph_h_p.push(h_p);
                        //横隔
                        var plan = new THREE.PlaneGeometry();
                        var ta = tabula1(ph[2],tabula_type);
                        plan.vertices = ta[0];
                        plan.faces = ta[1];
                        mesh1 = new THREE.Mesh( plan,material );
                        scene.add( mesh1 );
                        break;
                    case 3:
                        var position = parseInt($(value).find("input[name='position']").val());
                        var head_l1 = parseInt($(value).find("input[name='head_l1']").val());
                        var direction = "'"+$(value).find("select[name='direction']").val()+"'";

                        ph = pylon_head(ph_body[position-1][2],ph_body[position-1][3],ph_h_p[position-1],ph_height[position-1],head_l1,n,radian,part_type,direction);

                        //头部组件
                        var module_l1 = $(value).find("input[name='module_l1']").val();
                        var module_l2 = $(value).find("input[name='module_l2']").val();
                        var module_type = $(value).find("select[name='module_type']").val();
                        head_ph = pylon_head_other(ph[2],module_l1,module_l2,module_type,direction);

                        break;
                }
                console.log(ph);
                h_p = parseInt(h_p)+parseInt(height);
                //把坐标和索引放入立方体中
                cubeGeometry.vertices = ph[0];
                cubeGeometry.faces = ph[1];

                mesh = new THREE.Mesh( cubeGeometry,material );
                scene.add( mesh );
                if(head_ph){
                    var cubeHead = new THREE.Geometry();
                    cubeHead.vertices = head_ph[0];
                    cubeHead.faces = head_ph[1];
                }
            })

        }


        function threeStart() {
            setParameters();
            initThree();
            initCamera();
            initScene();
            initLight();
            initObject();
            animation();
        }

        //动漫
        function animation(){
            //renderer.clear();
            cameraRotate();
            renderer.render(scene, camera);

            requestAnimationFrame(animation);
        }

        function x(){
            var geometry = new THREE.Geometry();
            geometry.vertices.push( new THREE.Vector3( 0, 0, 0 ) );
            geometry.vertices.push( new THREE.Vector3( 1000, 0, 0 ) );
            var line = new THREE.Line( geometry, new THREE.LineBasicMaterial( { color: 0x000000, opacity: 0.2 } ) );
            scene.add( line );
        }
        function y(){
            var geometry = new THREE.Geometry();
            geometry.vertices.push( new THREE.Vector3( 0, 0, 0 ) );
            geometry.vertices.push( new THREE.Vector3( 0, 1000, 0 ) );
            var line = new THREE.Line( geometry, new THREE.LineBasicMaterial( { color: 0x00ae00, opacity: 0.2 } ) );
            scene.add( line );
        }
        function z(){
            var geometry = new THREE.Geometry();
            geometry.vertices.push( new THREE.Vector3( 0, 0, 0 ) );
            geometry.vertices.push( new THREE.Vector3( 0, 0, 1000 ) );
            var line = new THREE.Line( geometry, new THREE.LineBasicMaterial( { color: 0x000000, opacity: 0.2 } ) );
            scene.add( line );
        }

        function onWindowResize() {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize( window.innerWidth, window.innerHeight );
        }

        //摄像头旋转
        function cameraRotate(){
            camera.position.z = 300*Math.sin(t);
            camera.position.x = 300*Math.cos(t);
            camera.position.y = 200;
            camera.lookAt(0,0,0);
            t = t+0.01;
        }

    </script>
@endsection

