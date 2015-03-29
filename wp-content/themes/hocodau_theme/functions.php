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

wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_style('jquery-ui-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css', true);

wp_register_script('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css');


add_theme_support('post-thumbnails');
add_image_size('single', 317, 320);

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
add_role('english-center', 'English Center', array(
    'read' => true,
    'edit_posts' => true,
    'delete_posts' => false,
    'create_posts' => true,
    'publish_posts' => true
));

//register

add_action('init', 'create_account');

function create_account() {
    if (isset($_POST['register-submit'])) {
        $user = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $bio = $_POST['bio'];
    }
    if (!username_exists($user) && !email_exists($email)) {
        $user_id = wp_create_user($user, $pass, $email);
        if (!is_wp_error($user_id)) {
            $nuser = new WP_User($user);
            $nuser->set_role('author');
            wp_redirect(home_url());
            exit;
        }
    }
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
                    <p id="content-<?php comment_ID() ?>"><?php echo wp_trim_words(get_comment_text(), 35, '... <a class="load-more-comment" href="' . get_comment_ID() . '">Xem thêm</a>'); ?></p>

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

include_once 'user/ajax-login.php';
?>

    