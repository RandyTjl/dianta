/**
 * 挑战时加载页面
 */
function load_html(type) {
    switch (type){
        case 1:
            $html = '<i class="fa fa-spinner fa-spin fa-4x" style="color: #00a65a"></i>';
            break;
        case 2:
            $html = '<i class="fa fa-circle-o-notch fa-spin fa-4x" style="color: #00a65a"></i>';
            break;
        case 3:
            $html = '<i class="fa fa-refresh fa-spin fa-4x" style="color: #00a65a"></i>';
            break;
        case 4:
            $html = '<i class="fa fa-spinner fa-pulse fa-4x" style="color: #00a65a"></i>';
            break;
    }

    $("#load_html").html($html);
    $("#load_html").show();
}
//关掉加载页
function close_load_html() {
    $("#load_html").hide();
}



