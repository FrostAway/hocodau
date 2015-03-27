<?php

if (isset($_GET['filter-submit'])) {
    add_action('pre_get_posts', 'fl_getpost_query');

    function fl_getpost_query($query) {      
        if (is_tax('course-cat') || is_search()) {
            $query->set('posts_per_page', 8);
            if (isset($_GET['muc-gia']) && $_GET['muc-gia']!='') {
                $price = $_GET['muc-gia'];
                $splprice = split("-", $price);
                if (count($splprice) > 1) {
                    $metaquery = array(
                        array(
                            'key' => 'course-price',
                            'value' => $splprice,
                            'type' => 'numeric',
                            'compare' => 'BETWEEN'
                        )
                    );
                } else {
                    $metaquery = array(
                        array(
                            'key' => 'course-price',
                            'value' => $price,
                            'type' => 'numeric',
                            'compare' => '>'
                        )
                    );
                }
                    $query->set('meta_query', $metaquery);
            }

            if (isset($_GET['dau-vao']) && $_GET['dau-vao']!='') {
                $dv = $_GET['dau-vao'];
                $dv = split("-", $dv)[1];
                $query->set('meta_query', array(
                    array(
                        'key' => 'course-input',
                        'value' => $dv,
                        'type' => 'numeric',
                        'compare' => '='
                    )
                ));
            }
            if (isset($_GET['dia-diem']) && $_GET['dia-diem'] != '') {
                $prov = $_GET['dia-diem'];
                $prov = split('-', $prov)[1];
                $query->set('tax_query', array(
                    array(
                        'taxonomy' => 'city-center',
                        'field' => 'term',
                        'terms' => array($prov),
                        'operator' => 'IN'
                    )
                ));
            }

            if (isset($_GET['thoi-gian'])) {
                $tget = $_GET['time'];
                $tget = split('-', $tget)[1];
                $query->set('meta_query', array(
                    array(
                        'key' => 'course-month',
                        'value' => $tget,
                        'type' => 'numeric',
                        'compare' => '='
                    )
                ));
            }
        }
        if (is_tax('tutor-cat')) {
            $query->set('posts_per_page', 8);
            if (isset($_GET['tuoi'])) {
                $tuoi = $_GET['tuoi'];
                $spltuoi = split("-", $tuoi);
                if (count($spltuoi) > 1) {
                    $metaquery = array(
                        array(
                            'key' => 'tutor-age',
                            'value' => $spltuoi,
                            'type' => 'numeric',
                            'compare' => 'BETWEEN'
                        )
                    );
                } else {
                    $metaquery = array(
                        array(
                            'key' => 'tutor-age',
                            'value' => $tuoi,
                            'type' => 'numeric',
                            'compare' => '>'
                        )
                    );
                }
                $query->set('meta_query', $metaquery);
            }
        }
        if (is_tag()) {
            $query->set('post_type', 'course');
        }
    }
    
}

