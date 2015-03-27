<?php

function create_post_type_elct() {
    register_post_type('english-center', array(
        'labels' => array(
            'name' => 'English Center'
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_nav_menus' => false,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'rewrite' => array(
            'slug' => 'trung-tam-ta',
            'with_front' => FALSE,
        ),
        'supports' => array(
            'title', 'thumbnail', 'editor', 'excerpt', 'comments'
        ),
        'taxonomies' => array('post_tag')
    ));
}

add_action('init', 'create_post_type_elct');

//add field to post
add_action('add_meta_boxes', 'add_my_elct_field');

function add_my_elct_field() {
    add_meta_box('info-elct', 'Thông tin Trung tâm', 'show_elct_box', 'english-center', 'normal', 'high', array());
}

global $tt_fields;
$tt_fields = array(
    array(
        'type' => 'text',
        'name' => 'center-main',
        'label' => 'Khóa học trọng tâm',
        'size' => '40'
    ),
    array(
        'type' => 'text',
        'name' => 'center-ceo',
        'label' => 'CEO',
        'size' => '40'
    ),
    array(
        'type' => 'text',
        'name' => 'center-location',
        'label' => 'Địa điểm',
        'size' => '40'
    )
);

function show_elct_box() {
    global $tt_fields;
    global $post;
    $course = get_post_custom($post->ID);
    ?>
    <table id="list-table" class="course-info">
    <?php foreach ($tt_fields as $box) { ?>
            <?php
            switch ($box['type']) {
                case 'text':
                    if($box['name'] == 'center-location'){ 
                        $locates = unserialize(get_post_meta($post->ID, 'center-location', true));
                        $locates = ($locates == null) ? null : $locates; 
                        $city_lcs = unserialize(get_post_meta($post->ID, 'center-location-city', true));
                        $city_lcs = ($city_lcs == null) ? null : $city_lcs;
                        ?>
                        <tr>
                            <td>
                                <label><?php echo $box['label'] ?>: </label>
                                <button id="add-center-location" class="btn btn-default fa fa-plus" style="">Thêm</button>
                            </td>
                            <td></td>
                        </tr>
                        <?php $citys = get_terms('city-center', array('hide_empty'=>false));?>
                        <?php if($locates != null) foreach ($locates as $key => $lc){ ?>
                        <tr>
                            <td></td>
                            <td><input size="40" type="text" name="<?php echo $box['name'] ?>[]" value="<?= $lc ?>" /></td>
                            <td>
                                
                                <select name="center-location-city[]">
                                    <?php foreach ($citys as $city){ ?>
                                    <option <?php selected($city_lcs[$key], $city->term_id) ?> city="<?= $city_lcs[$key] ?>" value="<?= $city->term_id ?>"><?= $city->name ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <?php } ?>
                        
                        <script>
                            jQuery(document).ready(function(){
                               jQuery('#add-center-location').click(function(){
                                   var option = '<select name="center-location-city[]">'+
                                           '<?php
                                            foreach ($citys as $city){ 
                                                echo '<option value="'.$city->term_id.'">'.$city->name.'</option>';
                                            }
                                           ?>'
                                           +'</select>';
                                   var text = '<tr class="area-center-location"><td></td><td><input type="text" name="center-location[]" size="40" /></td><td>'+option+'</td><td><a class="del-center-location" hre="#">Xóa</a></td></tr>';
                                   jQuery('#list-table').append(text);
                                   jQuery('.del-center-location').click(function(e){
                                        e.preventDefault();
                                        jQuery(this).closest('.area-center-location').html('');
                                    });
                                   return false;
                               }) ;
                               
                            });
                        </script>
                        <div id="location-box"></div>
                    <?php }else{
                    ?>
                    <tr>
                        <td><label><?php echo $box['label'] ?>: </label></td>
                        <td><input size="<?= $box['size'] ?>" type="text" name="<?php echo $box['name'] ?>" value="<?php if (isset($course)) echo $course[$box['name']][0] ?>" /></td>
                    </tr>
                    <?php  }
                break;
            case 'date':
                ?>
                    <tr>
                        <td><label><?php echo $box['label'] ?>: </label></td>
                        <td><input size="<?= $box['size'] ?>" type="date" name="<?php echo $box['name'] ?>" value="<?php if (isset($course)) echo $course[$box['name']][0] ?>" /></td>
                    </tr>
                    <script>
                        jQuery(document).ready(function () {
                            jQuery(".course-info input[type=date]").datepicker({
                                'dateFormat': 'dd-mm-y'
                            });
                        });
                    </script>
                <?php
                break;
            default:
                break;
        }
        ?>

        <?php } ?>
                    <div id="footer-table">
                        <tr>
                            <td>Title</td><td>Website</td>
                        </tr>
                    </div>
    </table>
    <input type="hidden" name="english-center-information" />
    <?php
}

//save contact
add_action('save_post', 'update_elct_post');

function update_elct_post($post_id) {
    global $tt_fields;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'english-center' && isset($_POST['english-center-information'])) {
        foreach ($clb_fields as $box) {
            $value = $_POST[$box['name']];
            if(is_array($value)){
                $value = serialize($value);
            }
            update_post_meta($post_id, $box['name'], $_POST[$box['name']]);
        }
        update_post_meta($post_id, 'center-location-city', serialize($_POST['center-location-city']));
    } else {
        if (isset($_POST['english-center-information'])) {
            foreach ($clb_fields as $box) {
                delete_post_meta($post_id, $box['name']);
            }
            delete_post_meta($post_id, 'center-location-city');
        }
    }
    if (isset($_POST['english-center-information'])) {
        foreach ($tt_fields as $box) {
            $value = $_POST[$box['name']];
            if(is_array($value)){
                $value = serialize($value);
            }
            update_post_meta($post_id, $box['name'], $value);
        }
        update_post_meta($post_id, 'center-location-city', serialize($_POST['center-location-city']));
    }
}
