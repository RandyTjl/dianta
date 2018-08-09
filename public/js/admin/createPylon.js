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
var tabula_list = new Array();//横隔的數組
var bottom_list = new Array();//塔底的數組
var body_list = new Array();//塔身的數組
var head_list = new Array();//塔头的數組
var head_other_list = new Array();//塔头其他的數組


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
        var material = new THREE.MeshBasicMaterial({color:0x919191,wireframe : true,skinning:true});

        var pylon_type = Number($(value).find("input[name='pylon_type']").val());
        var height = parseInt($(value).find("input[name='height']").val());
        var n = parseInt($(value).find("input[name='n']").val());
        var part_type = parseInt($(value).find("select[name='part_type']").val());

        switch (pylon_type){
            case 1:
                ph = pylon_bottom(height,l1,l2,l3,n,radian);
                bottom_list['type'] = 1;
                bottom_list['part_type'] = 1;
                bottom_list['vertices'] = ph[0];
                bottom_list['faces'] = ph[1];
                bottom_list['height'] = height;
                bottom_list['n'] = n;

                //横隔
                var plan = new THREE.PlaneGeometry();
                var ta = tabula1(ph[2],tabula_type);
                tabula_list['type'] = 5;
                tabula_list['part_type'] = tabula_type;
                tabula_list['vertices'] = ta[0];
                tabula_list['faces'] = ta[1];

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
                tabula_list['type'] = 5;
                tabula_list['part_type'] = tabula_type;
                tabula_list['vertices'] = ta[0];
                tabula_list['faces'] = ta[1];

                plan.vertices = ta[0];
                plan.faces = ta[1];
                mesh1 = new THREE.Mesh( plan,material );
                scene.add( mesh1 );
                break;
            case 3:
                var position = parseInt($(value).find("input[name='position']").val());
                var head_l1 = parseInt($(value).find("input[name='head_l1']").val());
                var direction = $(value).find("select[name='direction']").val();

                ph = pylon_head(ph_body[position-1][2],ph_body[position-1][3],ph_h_p[position-1],ph_height[position-1],head_l1,n,radian,part_type,direction);

                //头部组件
                var module_l1 = parseInt($(value).find("input[name='module_l1']").val());
                var module_l2 = parseInt($(value).find("input[name='module_l2']").val());
                var module_type = parseInt($(value).find("select[name='module_type']").val());
                head_ph = pylon_head_other(ph[2],module_l1,module_l2,module_type,direction);

                break;
        }

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
            mesh = new THREE.Mesh( cubeHead,material );
            scene.add( mesh );
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
