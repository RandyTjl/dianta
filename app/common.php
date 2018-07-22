<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/7/7
 * Time: 17:28
 */

function createLeftMenu($datas,$level=0 ){
    $a = '';
    if(empty($_GET['menu_id'])){
        if(empty(\Illuminate\Support\Facades\Session::get('menu_id'))){
            $menu_id = 1;
        }else{
            $menu_id = \Illuminate\Support\Facades\Session::get('menu_id');
        }
    }else{
        $menu_id = $_GET['menu_id'];
        \Illuminate\Support\Facades\Session::put('menu_id',$menu_id);
    }

    $menu_parent_id = get_top_menu_id($datas,$menu_id);

    $html = '';
    $left_class = "padding-left:".(8*($level))."px";
    $size = "font-size:".(18-$level)."px";

    if(is_array($datas)){
        //等级为0的时候生成获取左侧菜单数组
        if($level == 0 ){
            $arrays = [];
            foreach ($datas as $data){
                if($data['id'] == $menu_parent_id){
                    $arrays[] = $data;
                }
            }
            if($menu_id == $menu_parent_id){
                $a = 0;
            }
        }else{
            $arrays = $datas;
        }
        foreach ($arrays as $key=>$array){
            $active = '';
            if(check_menu_exist($array,$menu_id) || $key === $a){
                $active = "active";
            }

            if(isset($array['_chirld'])){
                //$num = count($array['_chirld']);
                $html .= '<li class="nav-item has-treeview menu-open" style="'.$left_class.'">
                            <a href="'.$array['url'].'?menu_id='.$array['id'].'" class="nav-link '.$active.'" style="'.$size.'">
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
                $html .= '<li class="nav-item" style="'.$left_class.'">
                <a href="' . $array['url'] . '?menu_id=' . $array['id'] . '" class="nav-link '.$active.'" style="'.$size.'">
                  <i class="fa  ' . $array['icon'] . ' nav-icon"></i>
                   ' . $array['menu_name'] . '
                </a>
              </li>';

            }
        }
    }
    /*\Illuminate\Support\Facades\Session::put('menu_parent_id',$menu_parent_id);
    \Illuminate\Support\Facades\Session::put('left_menu',$html);
    \Illuminate\Support\Facades\Session::save();*/
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

//得到菜单的最上层的menu_id
function get_top_menu_id($datas,$menu_id){
   foreach ($datas as $data){
        $a = check_menu_exist($data,$menu_id);
       if($a !== false){
           return $data['id'];
       }
   }
}

/**
 * 判断菜单id是否存在于这个menu里面
 * @param $data
 * @param $menu_id
 * @return bool
 */
function check_menu_exist($data,$menu_id){
    $string = json_encode($data);
    $a = strpos($string,'"id":'.$menu_id.',');
    if($a !== false){
        return true;
    }else{
        return false;
    }
}

/**
 *权限展示和选择
 * @param $menus
 * @param $menu_id
 * @param int $level
 * @return string
 */
function power_check($menus,$menu_ids=[],$level=0){
    if(empty($menus)){
        $menus = \Illuminate\Support\Facades\Session::get('menus');
    }
    $html = '';
    foreach ($menus as $k=>$menu){
        $checked = '';
        if(in_array($menu['id'],$menu_ids)){
            $checked = 'checked';
        }
        if(isset($menu['_chirld'])){
            $html .= '<div class="form-group" style="margin-left: '.($level*5).'%">
                <label>
                <input type="checkbox" name="munu_ids[]" value="'.$menu['id'].'" class="flat-red" '.$checked.' >'.$menu['menu_name'].'
            </label>
            <div class="form-group" style="margin-left: 5%">';
            $html .=   power_check($menu['_chirld'],$menu_ids);
            $html .= '</div>';
            $html .= '</div>';
        }else{
            $html .= '<label style="margin-left: 10px;">
                <input type="checkbox" name="munu_ids[]" value="'.$menu['id'].'" class="flat-red" '.$checked.' >'.$menu['menu_name'].'
            </label>';
        }
    }
    return $html;
}

function role_list($role_ids=[]){
    $html = '';
    $roles = \App\Models\Role::whereNull('is_del')->get();
    foreach ($roles as $key=>$role){
        $check = '';
        if(in_array($role->id,$role_ids)){
            $check = 'checked';
        }
        $html .= '<label style="margin-left: 10px">
                    <input type="checkbox" class="minimal" '.$check.'  name="roles[]" value="' . $role->id . '">
                    <label class="form-check-label">' . $role->name .'</label>
                </label>';
    }
    return $html;
}

