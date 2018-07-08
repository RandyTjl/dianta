<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/7/7
 * Time: 17:28
 */

function createLeftMenu($datas,$level=0 ){
    $menu_id = empty($_GET['menu_id'])?'1':$_GET['menu_id'];


    $html = '';
    //$left_class = "padding-left:".(8*($level+1))."px";
    //$size = "font-size:".(18-$level)."px";

    if(is_array($datas)){
        if($level == 0 ){
            $arrays = [];
            foreach ($datas as $data){
                if($data['id'] == $menu_id){
                    $arrays[] = $data;
                }
            }
        }else{
            $arrays = $datas;
        }
        foreach ($arrays as $array){
            if(isset($array['_chirld'])){
                //$num = count($array['_chirld']);
                $html .= '<li class="nav-item has-treeview menu-open">
                            <a href="'.$array['url'].'?menu_id='.$array['id'].'" class="nav-link active">
                              <i class="nav-icon fa '.$array['icon'].'"></i>
                              <p>
                                '.$array['menu_name'].'
                                <i class="right fa fa-angle-left"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">';

                $html .= createLeftMenu($array['_chirld'],$level+1);

                $html .= '</ul></li>';
            }else {
                $html .= '<li class="nav-item">
                <a href="' . $array['url'] . '?menu_id=' . $array['id'] . '" class="nav-link active">
                  <i class="fa  ' . $array['icon'] . ' nav-icon"></i>
                   ' . $array['menu_name'] . '
                </a>
              </li>';

            }
        }
    }
    return $html;
}

function createTopMenu($menus){
    $top_html = '';
    foreach ($menus as $menu){
        $top_html .= ' <li class="nav-item d-none d-sm-inline-block">
            <a href="'.$menu['url']. '?menu_id=' . $menu['id'] . '" class="nav-link">'.$menu['menu_name'].'</a>
        </li>';
    }
    return $top_html;
}

/**
 * 左边的菜单按钮转换成树状结构
 * @param $menus
 * @param array $arrays
 * @return array
 */
function left_menu_tree($menus,$arrays=[]){
    foreach ($menus as $key=>$menu){
        if($menu['parent_id']){
            $arrays = left($menu,$arrays);
        }else{
            $arrays[] = $menu;
        }
    }
    return $arrays;
}

function left($menu,$arrays){
    foreach ($arrays as $k=>$array){
        if($menu['parent_id'] == $array['id']){
            $arrays[$k]['_chirld'][] = $menu;
        }else if(isset($array['_chirld'])){
            $arrays[$k]['_chirld'] = left($menu,$array['_chirld']);
        }
    }
    return $arrays;
}

/**
 * 把数据库拿到的值的相同key合并
 * @param $arrays
 * @return array
 */
function array_field($arrays){
    $data = [];
    foreach ($arrays as $array){
        foreach ($array as $key=>$arr){
            $data[$key][] = $arr;
        }
    }
    return $data;
}