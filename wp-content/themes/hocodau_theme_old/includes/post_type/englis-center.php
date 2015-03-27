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
            'slug' => 'english-center',
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

global $tt_fields, $provices;
$tt_fields = array(
    array(
        'type' => 'text',
        'name' => 'center-location',
        'label' => 'Địa điểm',
        'size' => '80'
    ),
    array(
        'type' => 'text',
        'name' => 'center-main',
        'label' => 'Khóa học trọng tâm',
        'size' => '80'
    ),
    array(
        'type' => 'text',
        'name' => 'center-ceo',
        'label' => 'CEO',
        'size' => '80'
    ),
);

function show_elct_box() {
    global $tt_fields, $provices;
    global $post;
    $course = get_post_custom($post->ID);
    ?>
    <table id="list-table" class="course-info">
    <?php foreach ($tt_fields as $box) { ?>
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
                        jQuery(document).ready(function () {
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
        foreach ($tt_fields as $box) {
            update_post_meta($post_id, $box['name'], $_POST[$box['name']]);
        }
    } else {
        if (isset($_POST['english-center-information'])) {
            foreach ($tt_fields as $box) {
                delete_post_meta($post_id, $box['name']);
            }
        }
    }
    if (isset($_POST['english-center-information'])) {
        foreach ($tt_fields as $box) {
            update_post_meta($post_id, $box['name'], $_POST[$box['name']]);
        }
    }
}
