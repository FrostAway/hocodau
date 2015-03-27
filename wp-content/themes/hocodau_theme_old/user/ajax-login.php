<?php

wp_register_script('user_script', get_template_directory_uri().'/user/user_script.js');
wp_localize_script('user_script', 'ajaxParam', array('ajaxurl'=>  admin_url('admin-ajax.php')));
wp_enqueue_script('user_script');

add_action('wp_ajax_login_ajax_action', 'fl_ajax_login');
add_action('wp_ajax_nopriv_login_ajax_action', 'fl_ajax_login');
function fl_ajax_login(){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = array();
    if(!wp_login($username, $password)){
        $result['stt'] = 1;
        $result['mess'] = 'Sai Tên đăng nhập hoặc Mật khẩu!';
    }else{
        wp_signon(array('user_login'=>$username, 'user_password'=>$password));
        $result['stt'] = 2;
        $result['mess'] = 'Đăng nhập thành công';
    }
    echo json_encode($result);
    die();
}
