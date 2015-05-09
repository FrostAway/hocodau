<?php


// cau lac bo tieng anh
function create_post_type_elclb() {
    register_post_type('english-club', array(
        'labels' => array(
            'name' => 'English Club'
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_nav_menus' => false,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-groups',
        'rewrite' => array(
            'slug' => 'cau-lac-bo',
            'with_front' => FALSE,
        ),
        'supports' => array(
            'title', 'thumbnail', 'editor', 'excerpt', 'comments'
        ),
        'taxonomies' => array('post_tag')
    ));  
   
}

add_action('init', 'create_post_type_elclb');

//add field to post
add_action('add_meta_boxes', 'add_my_elclb_field');

function add_my_elclb_field() {
    add_meta_box('info-elct', 'Thông tin Trung tâm', 'show_elclb_box', 'english-club', 'normal', 'high', array());
}

global $clb_fields, $provices;
$clb_fields = array(
     array(
        'type' => 'text',
        'name' => 'clb-location',
        'label' => 'Địa điểm',
        'size' => '80'
    ),
    array(
        'type' => 'date',
        'name' => 'clb-estab',
        'label' => 'Thành lập',
        'size' => '80'
    ),
    array(
        'type' => 'text',
        'name' => 'clb-number',
        'label' => 'Số lượng thành viên',
        'size' => '80'
    ),
    array(
        'type' => 'text',
        'name' => 'clb-active',
        'label' => 'Thời gian sinh hoạt',
        'size' => '80'
    ),
    array(
        'type' => 'text',
        'name' => 'clb-obj',
        'label' => 'Đối tượng',
        'size' => '80'
    )
);

function show_elclb_box() {
    global $clb_fields;
    global $post;
    $course = get_post_custom($post->ID);
    ?>
    <table id="list-table" class="course-info">
        <?php foreach ($clb_fields as $box) { ?>
            <?php
            switch ($box['type']) {
                case 'text':
                    ?>
                    <tr>
                        <td><label><?php echo $box['label'] ?>: </label></td>
                        <td><input size="<?= $box['size'] ?>" type="text" name="<?php echo $box['name'] ?>" value="<?php if (isset($course)) echo $course[$box['name']][0] ?>" /></td>
                    </tr>
                    <?php
                    break;
                case 'date':
                    ?>
                    <tr>
                        <td><label><?php echo $box['label'] ?>: </label></td>
                        <td><input size="<?= $box['size'] ?>" type="date" name="<?php echo $box['name'] ?>" value="<?php if (isset($course)) echo $course[$box['name']][0] ?>" /></td>
                    </tr>
                    <script>
                        jQuery(document).ready(function(){
                           jQuery(".course-info input[type=date]").datepicker({
                               'dateFormat': 'dd-mm-y'
                           }); 
                        });
                    </script>
                    <?php
                    break;
                    case 'select':
                    ?>
                    <tr>
                        <td><label><?php echo $box['label'] ?>: </label></td>
                        <td>
                            <select name="<?php echo $box['name'] ?>">
                                <?php foreach ($box['items'] as $key => $value) { ?>
                                    <option value="<?= $key ?>" <?php selected($course[$box['name']][0], $key) ?>><?= $value ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <?php
                    break;
                case 'textarea':
                    ?>
                    <tr>
                        <td><label><?php echo $box['label'] ?>: </label></td>
                        <td><textarea name="<?php echo $box['name'] ?>" rows="4" cols="80"  placeholder="content"><?php if (isset($course)) echo $course[$box['name']][0] ?></textarea></td>
                    </tr>
                    <?php
                    break;
                case 'checkbox':
                    $check = '';
                    if (isset($course)) {
                        $value = $course[$box['name']][0];
                        if ($value == 'on') {
                            $check = 'checked';
                        }
                    }
                    ?>
                    <tr>
                        <td><label><?php echo $box['label'] ?>: </label></td>
                        <td><input <?php echo $check; ?> type="checkbox" name="<?php echo $box['name'] ?>"</td>
                    </tr>
                    <?php
                    break;
                default:
                    break;
            }
            ?>
            
            
        <?php } ?>
    </table>
    <input type="hidden" name="english-club-information" />
    <?php
}

//save contact
add_action('save_post', 'update_elclb_post');

function update_elclb_post($post_id) {
    global $clb_fields;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'english-club' && isset($_POST['english-club-information'])) {
        foreach ($clb_fields as $box) {
            update_post_meta($post_id, $box['name'], $_POST[$box['name']]);
        }
    } else {
        if (isset($_POST['english-club-information'])) {
            foreach ($clb_fields as $box) {
                delete_post_meta($post_id, $box['name']);
            }
        }
    }
    if (isset($_POST['english-club-information'])) {
        foreach ($clb_fields as $box) {
            update_post_meta($post_id, $box['name'], $_POST[$box['name']]);
        }
    }
}

