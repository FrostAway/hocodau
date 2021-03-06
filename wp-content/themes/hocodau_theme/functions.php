<?php
global $provices;
$provices = array('1' => 'Quận Ba Đình', '2' => 'Quận Hoàn Kiếm', '3' => 'Quận Hai Bà Trưng', '4' => 'Quận Đống Đa', '5' => 'Quận Tây Hồ', '6' => 'Quận Cầu Giấy', '7' => 'Quận Thanh Xuân', '8' => 'Quận Hoàng Mai', '9' => 'Quận Long Biên', '10' => 'Huyện Từ Liêm', '11' => 'Huyện Thanh Trì', '12' => 'Huyện Gia Lâm', '13' => 'Huyện Đông Anh', '14' => 'Huyện Sóc Sơn', '15' => 'Quận Hà Đông', '16' => 'Thị xã Sơn Tây', '17' => 'Huyện Ba Vì', '18' => 'Huyện Phúc Thọ', '19' => 'Huyện Thạch Thất', '20' => 'Huyện Quốc Oai', '21' => 'Huyện Chương Mỹ', '22' => 'Huyện Đan Phượng', '23' => 'Huyện Hoài Đức', '24' => 'Huyện Thanh Oai', '25' => 'Huyện Mỹ Đức', '26' => 'Huyện Ứng Hoà', '27' => 'Huyện Thường Tín', '28' => 'Huyện Phú Xuyên', '29' => 'Huyện Mê Linh');
if (!is_admin() && !is_page(256)) {
    // echo '<script>window.location.href="'.  get_page_link(256).'"</script>'; die();
}

function removeHeadLinks() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
}

function iz_add_support(){
   add_theme_support('title-tag');
    add_theme_support('post-thumbnails'); 
    add_image_size('thumb_small', 240, 240, true);
    add_image_size('thumb_single', 400, 400, true);
    if(!is_admin()){
        show_admin_bar(false);
    }
}

add_action('after_setup_theme', 'iz_add_support');

wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_style('jquery-ui-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css', true);

wp_register_script('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css');

add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');

// Declare sidebar widget zone
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Sidebar Widgets',
        'id' => 'sidebar-widgets',
        'description' => 'These are widgets for the sidebar.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
}
if (function_exists('register_nav_menu')) {
    register_nav_menu('course-menu-2', 'Course Menus');
    register_nav_menu('review-menu', 'Review Menus');
    register_nav_menu('event-menu', 'Event Menus');
    register_nav_menu('tutor-menu', 'Tutor Menus');
	register_nav_menu('share-menu', 'Share Menus');
}

add_action('init', 'register_tax_city');

function register_tax_city() {
    register_taxonomy('city-center', array('course', 'english-center', 'english-club', 'teacher'), array(
        'labels' => array(
            'name' => 'Quận / Huyện',
        ),
        'public' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewirte' => array('slug' => 'city-center'),
        'query_var' => true
    ));
}

// get and set post view

function getPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return '0';
    }
    return $count;
}

// function to count views.
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// Add comment meta rating
add_action('comment_post', function($comment_id) {
    add_comment_meta($comment_id, 'rating', $_POST['rating'], true);
    add_comment_meta($comment_id, 'comment-vote', 0, true);
});

function short_desc($post_id, $lm) {
    if (get_the_excerpt() != '') {
        return wp_trim_words(get_the_excerpt(), $lm, ' .... ');
    } else {
        return wp_trim_words(get_the_content(), $lm, ' .... ');
    }
}

//breadcrumb
function the_breadcrumb() {
    global $post;
    echo '<ol class="breadcrumb">';
    if (!is_home()) {
        echo '<li><a href="';
        echo get_option('home');
        echo '">';
        echo 'Trang chủ';
        echo '</a></li>';
        if (is_tax('course-cat') || is_singular('course')) {
            echo '<li>';
            echo get_the_term_list($post->ID, 'course-cat', ' ', ', ');

            if (is_singular('course')) {
                echo '</li><li>';
                the_title();
                echo '</li>';
            }
        } elseif (is_category() || is_tax('course-cat') || is_single()) {
            echo '<li>';
            the_category(' </li><li> ');
            if (is_single()) {
                echo '</li><li>';
                the_title();
                echo '</li>';
            }
        } elseif (is_page()) {
            if ($post->post_parent) {
                $anc = get_post_ancestors($post->ID);
                $title = get_the_title();
                foreach ($anc as $ancestor) {
                    $output = '<li><a href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li> <li class="separator">/</li>';
                }
                echo $output;
                echo '<strong title="' . $title . '"> ' . $title . '</strong>';
            } else {
                echo '<li><strong> ' . get_the_title() . '</strong></li>';
            }
        }
    } elseif (is_tag()) {
        single_tag_title();
    } elseif (is_day()) {
        echo"<li>Archive for ";
        the_time('F jS, Y');
        echo'</li>';
    } elseif (is_month()) {
        echo"<li>Archive for ";
        the_time('F, Y');
        echo'</li>';
    } elseif (is_year()) {
        echo"<li>Archive for ";
        the_time('Y');
        echo'</li>';
    } elseif (is_author()) {
        echo"<li>Author Archive";
        echo'</li>';
    } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
        echo "<li>Blog Archives";
        echo'</li>';
    } elseif (is_search()) {
        echo"<li>Search Results";
        echo'</li>';
    }
    echo '</ol>';
}



include_once 'filter/filter-function.php';
//pagination
add_action('pre_get_posts', 'my_post_queries');

function my_post_queries($query) {
    // do not alter the query on wp-admin pages and only alter it if it's the main query
    if (!is_admin() && $query->is_main_query()) {
        // alter the query for the home and category pages 
        if (is_home()) {
            $query->set('posts_per_page', 8);
        }
        if (is_category()) {
            $query->set('posts_per_page', 8);
        }
        if (is_search()) {
            $query->set('posts_per_page', 8);
        }
        if (is_page(64)) {
            $query->set('posts_per_page', 2);
        }
    }
}

// convert currency viet nam
function unit($price) {
    if (is_numeric($price)) {
        return number_format($price, 0, ',', '.') . ' VNĐ';
    } else {
        $price_args = split(' ', $price);

        if (count($price_args) == 1) {
            return $price . ' VNĐ';
        } else {

            $partern = '/(vnđ)|(vnd)|(đ)/';
            $replace = 'VNĐ';
            $partern1 = '/buổi/';
            $price = preg_replace($partern, $replace, $price);
            $price = preg_replace($partern1, 'Buổi', $price);

            if (is_numeric($price_args[0])) {
                $price = number_format($price_args[0], 0, ',', '.') . ' ' . $price_args[1];
            }
            return $price;
        }
    }
}

// caculator rate
function cal_rate($post_id) {
    if (get_post_meta($post_id, '_kksr_avg', true) == '') {
        return 0;
    } else {
        return get_post_meta($post_id, '_kksr_avg', true);
    }
}

//add post type
include_once 'includes/add_post_type.php';
include_once 'includes/theme_option.php';
//include_once 'includes/show_column.php';



wp_enqueue_script('jquery');

add_action('admin_footer', function() {
    ?>
    <script>
        jQuery('#in-course-cat-27').prop("checked", true);
    </script>
    <?php
});

//add role

function fl_add_role(){
add_role('english-center-role', 'Trung tâm Tiếng Anh', array(
    'read' => true,
    'edit_posts' => true,
    'delete_posts' => false,
    'create_posts' => true,
    'publish_posts' => true
));
add_role('english-teacher-role', 'Giảng viên Tiếng Anh', array(
    'read' => true,
    'edit_posts' => true,
    'delete_posts' => false,
    'create_posts' => true,
    'publish_posts' => true
));
add_role('english-club-role', 'Câu lạc bộ Tiếng Anh', array(
    'read' => true,
    'edit_posts' => true,
    'delete_posts' => false,
    'create_posts' => true,
    'publish_posts' => true
));
}
register_activation_hook(__FILE__, 'fl_add_role');

//register

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}


function fl_register_script(){
    wp_register_script('user_script', get_template_directory_uri().'/user/user_script.js');
	 wp_localize_script('user_script', 'params', array('course_cat'=>  get_terms('course-cat', array('hide_empty'=>false))));
    wp_enqueue_script('user_script');
}
add_action('wp_enqueue_scripts', 'fl_register_script');
add_action('init', 'create_account');

function create_account() {
    if (isset($_POST['register-submit'])) {
        $user = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $bio = $_POST['bio'];
        $role = $_POST['default_role'];
        $curr_url = $_POST['current_url'];
        
        $addrs = $_POST['center-reg-addr'];
        
        if (!username_exists($user) && !email_exists($email)) {
        $user_id = wp_create_user($user, $pass, $email);
        
        if (!is_wp_error($user_id)) {
            $key = md5($user_id.'_'.$pass); $keylink = home_url().'/?verify-user='.$user_id.'-'.$key;
            add_user_meta($user_id, 'key-reg', $key);
            
            wp_mail($email, 
                    'Xác nhận Email đăng ký Hocodau.vn', 
                    'Chào mừng bạn đến với Hocodau.vn, Xin hãy <a href="'.$keylink.'">xác nhận email</a> để đăng nhập tài khoản trên hocodau.vn',
                    'From: Hocodau.vn <hocodau@gmail.com>'."\r\n");
            $nuser = new WP_User($user);
            $nuser->set_role($role);
            
            update_user_meta($user_id, 'first_name', $_POST['first-name']);
            add_user_meta($user_id, 'center-mana', $_POST['center-mana']);
            add_user_meta($user_id, 'center-course', $_POST['center-course']);
            add_user_meta($user_id, 'center-reg-addr', $addrs);
            add_user_meta($user_id, 'mydescription', $_POST['bio']);
            
            wp_redirect(home_url().'/?status=success');
            exit;
        }else{
            wp_redirect($curr_url.'/?status=error');
            exit;
        }
    }else{
        wp_redirect($curr_url.'/?status=exist');
        exit;
    }
    }
    
    if(isset($_GET['verify-user']) && $_GET['verify-user'] !== ''){
        $key = $_GET['verify-user'];
        $user_id = split('-', $key)[0];
        if(split('-', $key)[1] == get_user_meta($user_id, 'key-reg', true)){
            update_user_meta($user_id, 'key-reg', 1);
        }
    }
}

add_filter( 'wp_mail_content_type', 'set_html_content_type' );
function set_html_content_type(){
    return 'text/html';
}

//user field
add_action( 'show_user_profile', 'fl_show_user_field' );
add_action( 'edit_user_profile', 'fl_show_user_field' );

add_action( 'personal_options_update', 'fl_save_user_field' );
add_action( 'edit_user_profile_update', 'fl_save_user_field' );


function fl_show_user_field($user){
    if($user->roles[0] == 'english-center-role'){
    ?>
    <table class="form-table">
        <tr>
            <th>Tên giám đốc</th>
            <td><input type="text" name="center-mana" size="40" value="<?php echo get_user_meta($user->ID, 'center-mana', true) ?>" /></td>
        </tr>
        <tr>
            <th>Khóa học chủ đạo</th>
            <?php
            $center_course = get_user_meta($user->ID, 'center-course', true);
            $center_course = ($center_course == null) ? null : $center_course;
            
            $term_courses = get_terms('course-cat', array('hide_empty'=>false));
            if($term_courses != null){
            ?>
            <td>
                <?php foreach ($term_courses as $course){ ?>
                <?php 
                $check = '';
				if($center_course)
                if(in_array($course->term_id, $center_course)){
                    $check = 'checked';
                }
                        ?>
                <div>
                    <label>
                        <input <?php echo $check; ?> type="checkbox" name="center-course[]" value="<?= $course->term_id ?>" /> 
                        <?php echo ' '.  $course->name; ?>
                    </label>
                </div>
                <?php } ?>
            </td>
            <?php } ?>
        </tr>
        <tr>
            <th>Địa chỉ</th>
            <td></td>
        </tr>
         <?php
            $addrs = get_user_meta($user->ID, 'center-reg-addr', true);
            $addrs = ($addrs == null) ? null : $addrs;
            if($addrs != null){
                $i = 1;
                foreach ($addrs as $addr){ ?>
                <tr>
                    <th>Cơ sở <?php echo $i ?></th>
                    <td><input type="text" name="center-reg-addr[]" value="<?php echo $addr ?>" /></td>
                </tr>
                <?php }
            }
            ?>
			<tr>
                    <th>Giới thiệu</th>
                    <td><?php wp_editor(get_user_meta($user->ID, 'mydescription', true), 'mydescription', array('textarea_rows'=>7)); ?></td>
                </tr>
    </table>
    
    <script>
        jQuery('#your-profile .form-table .user-last-name-wrap').hide();
        jQuery('#your-profile .form-table .user-description-wrap').hide();
    </script>
    <?php
    }
}

function fl_save_user_field($user_id){
    if ( !current_user_can( 'edit_user', $user_id ) ){
		return false;
    }
	
    update_user_meta($user_id, 'center-mana', $_POST['center-mana']);
    update_user_meta($user_id, 'center-course', $_POST['center-course']);
    update_user_meta($user_id, 'center-reg-addr', $_POST['center-reg-addr']);
	update_user_meta($user_id, 'mydescription', $_POST['mydescription']);
}

//load more comment
function load_more_comment() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {

            jQuery('.load-more-comment').click(function () {
                var cmid = jQuery(this).attr('href');
                jQuery.ajax({
                    type: 'POST',
                    url: '<?php echo admin_url('admin-ajax.php') ?>',
                    data: {
                        action: 'load_more_comment',
                        cmid: cmid
                    },
                    success: function (data) {
                        $('#content-' + cmid).html(data);
                    }
                });
                return false;
            });
        });
    </script>
    <?php
}

add_action('wp_footer', 'load_more_comment');

add_action('wp_ajax_load_more_comment', 'ajax_load_more_comment');
add_action('wp_ajax_nopriv_load_more_comment', 'ajax_load_more_comment');

function ajax_load_more_comment() {
    if (isset($_POST['cmid'])) {
        $cmid = $_POST['cmid'];
        $content = get_comment_text($cmid);
        echo $content;
        die();
    }
}

add_action('comment_post', 'add_meta_comment_like');

function add_meta_comment_like($comment_id) {
    add_comment_meta($comment_id, 'comment_like', 0);
    add_comment_meta($comment_id, 'users_like', serialize(array()));
}

//vote comment


function comment_with_like($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class() ?> id="comment-<?php comment_ID() ?>">
        <article id="">
            <div class="avatar">
    <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size']); ?>

            </div>
            <div class="comment-main">
                <div class="author-name"><?php echo get_comment_author_link(); ?></div>

                <div class="comment-meta commentmetadata"><a href="<?php echo esc_url(get_comment_link($comment->comment_ID, $args)); ?>">
                        <?php
                        /* translators: 1: date, 2: time */
                        printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time());
                        ?></a><?php edit_comment_link(__('(Edit)'), '&nbsp;&nbsp;', '');
                ?>
                </div>
                <div class="comment-content">
                    <p id="content-<?php comment_ID() ?>"><?php echo wp_trim_words(get_comment_text(), 100, '... <a class="load-more-comment" href="' . get_comment_ID() . '">Xem thêm</a>'); ?></p>

                    <div class="reply">

                    </div>
                </div>
                <div class="comment-like">
                    <?php
                    $users_like = unserialize((get_comment_meta(get_comment_ID(), 'users_like', true) == null) ? array() : get_comment_meta(get_comment_ID(), 'users_like', true));
                    $curr_user_id = get_current_user_id();
                    if ($curr_user_id != 0 && in_array($curr_user_id, $users_like)) {
                        $like = 'Dislike';
                    } else {
                        $like = 'Like';
                    }
                    ?>
                    <a class="comment-like-btn" author-id="<?= $curr_user_id ?>" author-name="<?= get_comment_author(); ?>" comment-id="<?php comment_ID() ?>" href="#"><?= $like ?></a> || <span class="num_like"><?= get_comment_meta($comment->comment_ID, 'comment_like', true) ?></span>
                    <span class="stt_login"></span>
    <?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply <span>&darr;</span>'), 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>
            </div>
        </article>
    </li>
    <?php
}

add_action('init', 'comment_like_script');

function comment_like_script() {
    wp_register_script('comment_like', get_template_directory_uri() . '/assets/js/comment_like.js');
    wp_localize_script('comment_like', 'ajaxParams', array('ajaxurl' => admin_url('admin-ajax.php')));

    wp_enqueue_script('comment_like');
}

add_action('wp_ajax_comment_like_action', 'comment_like_ajax');
add_action('wp_ajax_nopriv_comment_like_action', 'comment_like_ajax_login');

function comment_like_ajax() {
    $comment_id = $_POST['comment_id'];
    $author_id = $_POST['author_id'];

    $num_like = get_comment_meta($comment_id, 'comment_like', true);
    $num_like = ($num_like == '') ? 0 : $num_like;

    $respond = array();
    $respond['stt_login'] = 1;

    $users_like = unserialize(get_comment_meta($comment_id, 'users_like', true));
    $users_like = ($users_like == '') ? array() : $users_like;
    if (in_array($author_id, $users_like)) {
        $respond['stt_login'] = 3;
        $new_num = $num_like - 1;
        $like = update_comment_meta($comment_id, 'comment_like', $new_num);
        foreach ($users_like as $key => $value) {
            if ($value == $author_id) {
                unset($users_like[$key]);
                break;
            }
        }
        update_comment_meta($comment_id, 'users_like', serialize($users_like));
        $respond['num_like'] = $new_num;
    } else {
        $new_num = $num_like + 1;
        $like = update_comment_meta($comment_id, 'comment_like', $new_num);
        if ($like == false) {
            $respond['num_like'] = $num_like;
        } else {
            $respond['num_like'] = $new_num;
            $users_like[] = $author_id;
            update_comment_meta($comment_id, 'users_like', serialize($users_like));
        }
    }

    echo json_encode($respond);
    die();
}

function comment_like_ajax_login() {
    $respond['stt_login'] = 2;
    $respond['num_like'] = 'Bạn phải đăng nhập! <a data-target="#loginform" data-toggle="modal" href="#">Login</a>';
    echo json_encode($respond);
    die();
}

// comment rank

add_action('wp_ajax_comment_rank_action', 'fl_comment_rank');
add_action('wp_ajax_nopriv_comment_rank_action', 'fl_comment_rank');

function fl_comment_rank() {
    $post_id = $_POST['post_id'];
    $rank = $_POST['rank'];
    if ($rank == 'new') {
        wp_list_comments(array(
            'avatar_size' => 87,
            'callback' => 'comment_with_like'
                ), get_comments(array(
            'post_id' => $post_id
        )));
    } else {
        wp_list_comments(array(
            'avatar_size' => 87,
            'callback' => 'comment_with_like'
                ), get_comments(array(
            'post_id' => $post_id,
            'meta_key' => 'comment_like',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        )));
    }
    die();
}


add_action('wp_ajax_load_more_post', 'iz_load_more_post');
add_action('wp_ajax_nopriv_load_more_post', 'iz_load_more_post');
function iz_load_more_post(){
    $page = $_POST['page'];
     $posts = query_posts(array('post_type'=>'course', 'offset'=>8*$page, 'posts_per_page'=>8));
    global $wp_query;   
    if($page <= $wp_query->found_posts){  
        include_once 'template/course_loop.php';
    }else{
        echo 'no post found';
    }
    die();
}


add_action('wp_ajax_load_more_post_eng_id', 'iz_load_more_post_eng_id');
add_action('wp_ajax_nopriv_load_more_post_eng_id', 'iz_load_more_post_eng_id');
function iz_load_more_post_eng_id(){
    $page = $_POST['page'];
     query_posts(array('post_type' => 'course', 'meta_key' => 'eng-center-id', 'meta_value' => $_POST['eng_id'],'offset'=>5*$page, 'posts_per_page'=>5));
    global $wp_query;   
    if($page <= $wp_query->found_posts){  
    while(have_posts()): the_post();
    ?>
    <div class="post row">
        <div class="col-xs-3 col-md-4 col-lg-2">
            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail() ?></a>
        </div>
        <div class="col-xs-9 col-md-8 col-lg-6 post-content">
            <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <p class="hidden-xs hidden-sm">
                <?php echo short_desc(get_the_ID(), 65); ?>
            </p>
        </div>
        <div class="col-xs-12 col-md-12 col-lg-4 ">
            <table class="post-info">
                <tr>
                    <td class="lb ">Giá</td>
                    <td class="info price"><?= unit(get_post_meta(get_the_ID(), 'course-price', true)); ?></td>
                </tr>
                <tr>
                    <td class="lb">Đánh giá</td>
                    <td class="info">
                        <div class="rating">
                            <div title="5.00 / 5 điểm" class="star-rating">
                                <span>
                                    <strong class="num"><?= cal_rate(get_the_ID()) ?></strong> trên 5			
                                </span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="">
                    <?php
                    $center_id = get_post_meta(get_the_ID(), 'eng-center-id', true);
                    if ($center_id != 0) {
                        ?>
                        <th class="lb">Trung tâm</th>
                        <td class="info"><a href="<?= get_permalink($center_id) ?>"><?= get_the_title($center_id) ?></a></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="lb">Thời gian</td>
                    <td class="info"><?= wp_trim_words(get_post_meta(get_the_ID(), 'course-time', true), 2, ''); ?></td>
                </tr>
                <tr>
                    <td class="lb">Địa điểm</td>
                    <td class="info">
                        <?php
                        $terms = get_the_terms(get_the_ID(), 'city-center');
                        if ($terms)
                            foreach ($terms as $term) {
                                echo '<div>' . $term->name . '</div>';
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <?php edit_post_link("Edit"); ?>
    <hr class="clearfix" />
    <?php
    endwhile;    wp_reset_query();
    }else{
        echo 'no post found';
    }
    die();
}

include_once 'user/ajax-login.php';



add_action('admin_menu', 'fl_remove_menu_items');
function fl_remove_menu_items(){
    global $current_user;
    if($current_user->roles[0] == 'english-center-role'){
        remove_menu_page('edit.php?post_type=teacher');
        remove_menu_page('edit.php?post_type=english-club');
        remove_menu_page('edit.php?post_type=event');
        remove_menu_page('edit.php?post_type=english-tutor');
    }
}

add_action('admin_init', 'iz_add_role_cap', 999);
function iz_add_role_cap(){
    $roles = array('english-center-role', 'editor','administrator');
    foreach ($roles as $the_role){
        $role = get_role($the_role);
        $role->add_cap('read');
        $role->add_cap('read_english-center');
        $role->add_cap( 'read_private_english-centers' );
	    $role->add_cap( 'edit_english-center' );
	    $role->add_cap( 'edit_english-centers' );
	    $role->add_cap( 'edit_others_english-centers' );
	    $role->add_cap( 'edit_published_english-centers' );
	    $role->add_cap( 'publish_english-centers' );
	    $role->add_cap( 'delete_others_english-centers' );
	    $role->add_cap( 'delete_private_english-centers' );
	    $role->add_cap( 'delete_published_english-centers' );
    }
}


function posts_for_current_author($query) {
	global $pagenow;

	if( 'edit.php' != $pagenow || !$query->is_admin )
	    return $query;

	if( !current_user_can( 'manage_options' ) ) {
		global $user_ID;
		$query->set('author', $user_ID );
	}
	return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');

?>

    