<?php
// english center
include_once 'post_type/englis-center.php';
include_once 'post_type/english-club.php';
include_once 'post_type/english-event.php';
include_once 'post_type/english-teacher.php';
include_once 'post_type/english-tutor.php';

function create_post_type_course() {
    register_post_type('course', array(
        'labels' => array(
            'name' => 'Khóa học'
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_nav_menus' => false,
        'menu_position' => 3,
        'menu_icon' => 'dashicons-editor-spellcheck',
        'rewrite' => array(
            'slug' => 'khoa-hoc',
            'with_front' => FALSE,
        ),
        'supports' => array(
            'title', 'thumbnail', 'revisions', 'editor', 'excerpt', 'comments'
        ),
        'taxonomies' => array('post_tag')
    ));
    register_taxonomy('course-cat', 'course', array(
        'labels' => array(
            'name' => 'Danh mục khóa học',
        ),
        'public' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewirte' => array('slug' => 'muc-khoa-hoc'),
        'query_var' => true
    ));
}

add_action('init', 'create_post_type_course');

//add field to post
add_action('add_meta_boxes', 'add_my_eng_center_field');

add_action('add_meta_boxes', 'add_my_post_field');

function add_my_eng_center_field() {
    add_meta_box('parent-info-id', 'Chọn danh mục', 'show_center_id_box', 'course', 'normal', 'high', array());
}
function add_my_post_field() {
    add_meta_box('info-course', 'Thông tin khóa học', 'show_course_box', 'course', 'normal', 'high', array());
}


global $post_fields;
$cinput = array('1' => 'Beginer', '2' => 'Medium', '3' => 'Advance');
global $provices;

$post_fields = array(
    array(
        'type' => 'checkbox',
        'name' => 'course-featured',
        'label' => 'Hot',
        'size' => '5'
    ),
    array(
        'type' => 'text',
        'name' => 'course-price',
        'label' => 'Giá',
        'size' => '40'
    ),
    array(
        'type' => 'select',
        'name' => 'course-input',
        'label' => 'Đầu vào',
        'size' => '40',
        'items' => $cinput
    ),
    array(
        'type' => 'date',
        'name' => 'course-time',
        'label' => 'Thời gian',
        'size' => '40'
    ),
    array(
        'type' => 'hidden',
        'name' => 'course-month',
        'label' => 'Month',
        'size' => '40'
    ),
    array(
        'type' => 'text',
        'name' => 'course-location',
        'label' => 'Địa điểm',
        'size' => '40'
    ),
//    array(
//        'type' => 'text',
//        'name' => 'course-mana',
//        'label' => 'Giảng viên',
//        'size' => '40'
//    ),
//    array(
//        'type' => 'text',
//        'name' => 'course-cons',
//        'label' => 'Lịch học',
//        'size' => '40'
//    )
);

function show_center_id_box($post) {
    $center_id = get_post_meta($post->ID, 'eng-center-id', true);
    $teacher_id = get_post_meta($post->ID, 'eng-teacher-id', true);
    $tutor_id = get_post_meta($post->ID, 'eng-tutor-id', true);

    $parents = get_posts(array('post_type' => 'english-center', 'numberposts'=>-1));
    echo 'Chọn trung tâm Tiếng Anh';
    if (!empty($parents)) {
        echo '<select name="eng-center-id" id="eng-center-id" class="widefat">'; // !Important! Don't change the 'parent_id' name attribute.
        echo '<option value="0">Chọn trung tâm</option>';
        foreach ($parents as $parent) {
            printf('<option value="%s"%s>-- %s</option>', esc_attr($parent->ID), selected($parent->ID, $center_id, false), esc_html($parent->post_title));
        }
		wp_reset_postdata();
        echo '</select>';
    }

    $teachers = get_posts(array('post_type' => 'teacher','numberposts'=>-1, 'orderby' => 'title', 'order' => 'ASC'));
    echo 'Giáo viên Tiếng Anh';
    if (!empty($teachers)) {
        echo '<select name="eng-teacher-id" class="widefat">'; // !Important! Don't change the 'parent_id' name attribute.
        echo '<option value="0">Chọn Giảng viên</option>';
        foreach ($teachers as $parent) {
            printf('<option value="%s"%s>-- %s</option>', esc_attr($parent->ID), selected($parent->ID, $teacher_id, false), esc_html($parent->post_title));
        }
		wp_reset_postdata();
        echo '</select>';
    }
    
    $tutors = get_posts(array('post_type' => 'english-tutor','numberposts'=>-1, 'orderby' => 'title', 'order' => 'ASC'));
    echo 'Gia Sư Tiếng Anh';
    if (!empty($teachers)) {
        echo '<select name="eng-tutor-id" class="widefat">'; // !Important! Don't change the 'parent_id' name attribute.
        echo '<option value="0">Chọn gia sư</option>';
        foreach ($tutors as $parent) {
            printf('<option value="%s"%s>-- %s</option>', esc_attr($parent->ID), selected($parent->ID, $tutor_id, false), esc_html($parent->post_title));
        }
        echo '</select>';
    }
}

add_action('admin_footer', 'ajax_eng_center_addr');
function ajax_eng_center_addr(){
    ?>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery('#eng-center-id').change(function () {
                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        data: {
                            action: 'get_addr_center',
                            center_id: jQuery(this).val()
                        },
                        success: function (data) {
//                            jQuery('#course-center-addr').val(data);
                                jQuery('#list-table .area-center-location').html(' ');
                                jQuery('#list-table').append(data);
                        }
                    });
                });
            });
        </script>
        <?php
}
add_action('wp_ajax_get_addr_center', 'get_addr_center');
add_action('wp_ajax_nopriv_get_addr_center', 'get_addr_center');
function get_addr_center(){
    if(isset($_POST['center_id'])){
        $center_id = $_POST['center_id'];
        $eng_center = unserialize(get_post_meta($center_id, 'center-location', true));
        $eng_center = ($eng_center == null) ? null : $eng_center;
        $text = '';
        if($eng_center != null){
            $i = 0;
            foreach ($eng_center as $addr){
                if($addr!=''){
                $i = $i+1;
                $text .= '<tr class="area-center-location"><td>Lịch học ĐC '.$i.': </td><td><input type="text" name="course-calendar[]" size="40" /></td><td><strong>'.$addr.'</strong></td></tr>';
                }
            }
        }
        echo $text;
        die();
    }
}

function show_course_box() {
    global $post_fields;
    global $post;
    $course = get_post_custom($post->ID);
    ?>
    <table id="list-table" class="course-info">
        <?php foreach ($post_fields as $box) { ?>
            <?php
            switch ($box['type']) {
                case 'text':
                    if($box['name'] == 'course-location'){
                        
                    }
                    ?>
                    <tr>
                        <td><label><?php echo $box['label'] ?>: </label></td>
                        <?php if($box['name'] == 'course-price'){ ?>
                        <td><input size="<?= $box['size'] ?>" <?php if ($box['name'] == 'course-location') echo 'id="course-center-addr"'; ?> type="number" name="<?php echo $box['name'] ?>" value="<?php if (isset($course)) echo $course[$box['name']][0] ?>" /></td>
                        <?php }else{ ?>
                        <td><input size="<?= $box['size'] ?>" <?php if ($box['name'] == 'course-location') echo 'id="course-center-addr"'; ?> type="text" name="<?php echo $box['name'] ?>" value="<?php if (isset($course)) echo $course[$box['name']][0] ?>" /></td>
                        <?php } ?>
                    </tr>
                    <?php
                    break;
                case 'date':
                    ?>
                    <tr>
                        <td><label><?php echo $box['label'] ?>: </label></td>
                        <td><input size="<?= $box['size'] ?>" type="text" name="<?php echo $box['name'] ?>" value="<?php if (isset($course)) echo $course[$box['name']][0] ?>" />
                            <input type="hidden" class="button" id="btn-hidden-date" /></td>
                    </tr>
                    <script>
                        jQuery(document).ready(function () {
                            jQuery("#btn-hidden-date").datepicker({
                                dateFormat: 'dd-mm-y',
                                showOn: 'button',
                                buttonText: 'Choose',
                                onClose: function (dateText, inst) {
                                    var strdate = dateText.split("-");
                                    jQuery(".course-info input[type=hidden]").val(strdate[1]);
                                    jQuery(".course-info input[name=course-time]").val(jQuery(".course-info input[name=course-time]").val()+' '+dateText);
                                }
                            });
                        });
                    </script>
                    <?php
                    break;
                case 'hidden':
                    ?>
                    <tr>
                        <td><input size="<?= $box['size'] ?>" type="hidden" name="<?php echo $box['name'] ?>" value="<?php if (isset($course)) echo $course[$box['name']][0] ?>" /></td>
                    </tr>
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
                    <?php 
                    $cal_addrs = unserialize(get_post_meta($post->ID, 'course-calendar', true)); 
                    $cal_addrs = ($cal_addrs == null) ? null : $cal_addrs;
                    $center_id = get_post_meta($post->ID, 'eng-center-id', true);
                    $eng_centers = unserialize(get_post_meta($center_id, 'center-location', true));
                    $eng_centers = ($eng_centers == null) ? null : $eng_centers;
                    if($cal_addrs != null){
                        $i = 0;
                        foreach ($cal_addrs as $key => $addr){
                            $i = $i+1;
                    ?>
                    <tr class="area-center-location"><td>Lịch học ĐC<?= $i ?>: </td><td><input type="text" name="course-calendar[]" value="<?= $addr ?>" size="40" /></td><td><?php echo $eng_centers[$key] ?></td></tr>
                    <?php } } ?>
        <input type="hidden" name="course-information" />
    </table>
    <?php
}

//save contact
add_action('save_post', 'update_my_post');

function update_my_post($post_id) {
    global $post_fields;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Check the user's permissions.
    if (isset($_POST['post_type']) && 'course' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }
    if (isset($_POST['course-information'])) {
        foreach ($post_fields as $box) {
            update_post_meta($post_id, $box['name'], $_POST[$box['name']]);
        }
        update_post_meta($post_id, 'eng-center-id', $_POST['eng-center-id']);
        update_post_meta($post_id, 'eng-teacher-id', $_POST['eng-teacher-id']);
        update_post_meta($post_id, 'eng-tutor-id', $_POST['eng-tutor-id']);
        update_post_meta($post_id, 'course-calendar', serialize($_POST['course-calendar']));
    }
}
