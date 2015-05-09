<?php

wp_register_script('user_script', get_template_directory_uri() . '/user/user_script.js');
wp_localize_script('user_script', 'ajaxParam', array('ajaxurl' => admin_url('admin-ajax.php')));
wp_enqueue_script('user_script');

add_action('wp_ajax_login_ajax_action', 'fl_ajax_login');
add_action('wp_ajax_nopriv_login_ajax_action', 'fl_ajax_login');

function fl_ajax_login() {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = array();
    if (username_exists($username)) {
        $nuser = get_user_by('login', $username);
        $key_reg = get_user_meta($nuser->ID, 'key-reg', true);
        if ($key_reg =='' || $key_reg == 1) {
            if (!wp_login($username, $password)) {
                $result['stt'] = 1;
                $result['mess'] = 'Sai Tên đăng nhập hoặc Mật khẩu!';
            } else {
                wp_signon(array('user_login' => $username, 'user_password' => $password));
                $result['stt'] = 2;
                $result['mess'] = 'Đăng nhập thành công';
            }
            
        } else {
            $result['stt'] = 3;
            $result['mess'] = 'Tài khoản chưa kích hoạt, vui lòng kích hoạt Email!';
        }
    }

    echo json_encode($result);
    die();
}
