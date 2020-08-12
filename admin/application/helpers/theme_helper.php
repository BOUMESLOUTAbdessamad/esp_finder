<?php

function view_loader($view, $vars=array(), $output = false){
    $CI = &get_instance();
    return $CI->load->view($view, $vars, $output);
}

function active_menu($controller = null,$method = null) {
    $CI = &get_instance();
    $data['controller'] = $CI->router->fetch_class();
    $data['method'] = $CI->router->fetch_method();
    if($controller == $data['controller'] && !$method) {
        return "active";
    }
    if($controller == $data['controller'] && $method == $data['method']) {
        return "active";
    }
    return null;
    //
}

function nav_data() {
    $CI = &get_instance();
    //collect notifications
    $notifications = $CI->db->where('type',"notification")->get('notifications')->result_array();
    $messages = $CI->db->where('type',"message")->order_by("created","desc")->get('notifications')->result_array();
    return ["notifications" => $notifications,"messages" => $messages];
}

function themeHeader() {
    echo view_loader("headers/main.php");
}
?>