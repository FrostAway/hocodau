<?php



// giang vien

function create_post_type_tc() {
    register_post_type('teacher', array(
        'labels' => array(
            'name' => 'Giảng viên'
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_nav_menus' => false,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-id-alt',
        'rewrite' => array(
            'slug' => 'giao-vien-ta',
            'with_front' => FALSE,
        ),
        'supports' => array(
            'title', 'thumbnail', 'editor', 'excerpt', 'comments'
        ),
        'taxonomies' => array('post_tag')
    ));  
   
}

add_action('init', 'create_post_type_tc');

//add field to post
add_action('add_meta_boxes', 'add_my_tc_field');

function add_my_tc_field() {
    add_meta_box('info-elct', 'Thông tin Giảng viên', 'show_tc_box', 'teacher', 'normal', 'high', array());
}

global $tc_fields, $provices;
$tc_fields = array(
    array(
        'type' => 'text',
        'name' => 'tc-cl-location',
        'label' => 'Địa điểm lớp học',
        'size' => '80'
    ),
    array(
        'type' => 'text',
        'name' => 'tc-age',
        'label' => 'Tuổi',
        'size' => '80'
    ),
    array(
        'type' => 'text',
        'name' => 'tc-exp',
        'label' => 'Kinh nghiệm',
        'size' => '80'
    ),
    array(
        'type' => 'select',
        'name' => 'tc-cat',
        'label' => 'Loại Giảng viên',
        'size' => '80',
        'items' => array('1'=>'Việt Nam', '2'=>'Nước Ngoài')
    )
);

function show_tc_box() {
    global $tc_fields;
    global $post;
    $course = get_post_custom($post->ID);
    ?>
    <table id="list-table" class="course-info">
        <?php foreach ($tc_fields as $box) { ?>
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
    <input type="hidden" name="english-tc-information" />
    <?php
}

//save contact
add_action('save_post', 'update_tc_post');

function update_tc_post($post_id) {
    global $tc_fields;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'teacher' && isset($_POST['english-tc-information'])) {
        foreach ($tc_fields as $box) {
            update_post_meta($post_id, $box['name'], $_POST[$box['name']]);
        }
    } else {
        if (isset($_POST['english-club-information'])) {
            foreach ($tc_fields as $box) {
                delete_post_meta($post_id, $box['name']);
            }
        }
    }
    if (isset($_POST['english-club-information'])) {
        foreach ($tc_fields as $box) {
            update_post_meta($post_id, $box['name'], $_POST[$box['name']]);
        }
    }
}

