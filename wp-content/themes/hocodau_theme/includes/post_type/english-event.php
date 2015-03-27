<?php



// event

function create_post_type_event() {
    register_post_type('event', array(
        'labels' => array(
            'name' => 'Sự kiện'
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_nav_menus' => false,
        'menu_position' => 7,
        'menu_icon' => 'dashicons-admin-links',
        'rewrite' => array(
            'slug' => 'su-kien-ta',
            'with_front' => FALSE,
        ),
        'supports' => array(
            'title', 'thumbnail', 'editor', 'excerpt', 'comments'
        ),
        'taxonomies' => array('post_tag')
    ));
    register_taxonomy('event-cat', 'event', array(
        'labels' => array(
            'name' => 'Danh mục sự kiện',
        ),
        'public' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewirte' => array('slug' => 'event-cat'),
        'query_var' => true
    ));
   
}

add_action('init', 'create_post_type_event');

//add field to post
add_action('add_meta_boxes', 'add_my_event_field');

function add_my_event_field() {
    add_meta_box('info-course', 'Thông tin Sự kiện', 'show_event_box', 'event', 'normal', 'high', array());
    add_meta_box('parent-club', 'Danh sách câu lạc bộ', 'show_club_parent_box', 'event', 'side', 'core', array());
}

global $ev_fields, $provices;
$ev_fields = array(
    array(
        'type' => 'date',
        'name' => 'event-time',
        'label' => 'Thời gian',
        'size' => '80'
    ),
    array(
        'type' => 'text',
        'name' => 'event-location',
        'label' => 'Địa điểm',
        'size' => '80'
    ),
    array(
        'type' => 'text',
        'name' => 'event-obj',
        'label' => 'Đối tượng tham gia',
        'size' => '80'
    ),
    array(
        'type' => 'text',
        'name' => 'event-price',
        'label' => 'Mức phí',
        'size' => '80'
    ),
);


function show_event_box() {
    global $ev_fields;
    global $post;
    $course = get_post_custom($post->ID);
    ?>
    <table id="list-table" class="course-info">
        <?php foreach ($ev_fields as $box) { ?>
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
            <input type="hidden" name="event-information" />
            
        <?php } ?>
    </table>
    <?php
}

function show_club_parent_box($post){
    $club_id = get_post_meta($post->ID, 'club-id', true);

    $parents = get_posts(array('post_type' => 'english-club', 'orderby' => 'title', 'order' => 'ASC'));
    echo 'Câu lạc bộ Tiếng Anh';
    if (!empty($parents)) {
        echo '<select name="club-id" class="widefat">'; // !Important! Don't change the 'parent_id' name attribute.
        foreach ($parents as $parent) {
            printf('<option value="%s"%s>%s</option>', esc_attr($parent->ID), selected($parent->ID, $club_id, false), esc_html($parent->post_title));
        }
        echo '</select>';
    }
}

//save contact
add_action('save_post', 'update_my_event');

function update_my_event($post_id) {
    global $ev_fields;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'course' && isset($_POST['event-information'])) {
        foreach ($ev_fields as $box) {
            update_post_meta($post_id, $box['name'], $_POST[$box['name']]);
        }
        update_post_meta($post_id, 'club-id', $_POST['club-id']);
    } else {
        if (isset($_POST['event-information'])) {
            foreach ($ev_fields as $box) {
                delete_post_meta($post_id, $box['name']);
            }
            delete_post_meta($post_id, 'club-id');
        }
    }
    if (isset($_POST['save']) && isset($_POST['event-information'])) {
        foreach ($ev_fields as $box) {
            update_post_meta($post_id, $box['name'], $_POST[$box['name']]);
        }
        update_post_meta($post_id, 'club-id', $_POST['club-id']);
    }
}

