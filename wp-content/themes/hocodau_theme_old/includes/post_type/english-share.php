<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function create_post_type_elshare() {
    register_post_type('english-share', array(
        'labels' => array(
            'name' => 'Chia sẻ'
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_nav_menus' => false,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-share',
        'rewrite' => array(
            'slug' => 'chia-se',
            'with_front' => false,
        ),
        'supports' => array(
            'title', 'thumbnail', 'editor', 'excerpt', 'comments'
        )
    ));
    register_taxonomy('share-cat', 'english-share', array(
        'labels' => array(
            'name' => 'Danh mục Chia sẻ',
        ),
        'public' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'muc-chia-se', 'with_front'=>false),
    ));
}

add_action('init', 'create_post_type_elshare');
