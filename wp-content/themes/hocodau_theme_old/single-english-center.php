<?php get_header(); ?>

<?php setPostViews(get_the_ID()) ?>
<div id="main">
    <div class="main-bg"></div>
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 column-right">                       

                <?php if (have_posts()): while (have_posts()): the_post(); ?>

                        <div id="post" class="clearfix">
                           <div class="breadcrumb"><?php echo yoast_breadcrumb(); ?></div>

                            <div class="col-sm-12 col-lg-5">
                                <?php
                                echo get_the_post_thumbnail(get_the_ID(), 'single', array(
                                    'class' => 'post-thumbnail img-responsive'
                                ))
                                ?>
                            </div>
                            <div class="col-sm-12 col-lg-7 content">
                                <h3 class="content-title"><?php the_title(); ?></h3>
                                <table class="short-desc">
                                    <tr>
                                        <td class="cl1"><div class="">Xếp hạng chất lượng</div></td>
                                        <td>
                                            <div class="rating">
                                                <div title="" class="star-rating">
                                                    <span>
                                                        <strong class="num"><?php echo cal_rate(get_the_ID()); ?></strong> trên 5			
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="lb">Địa điểm</td>
                                        <td class="info">
                                            <?php
                                            $locates = unserialize(get_post_meta(get_the_ID(), 'center-location', true));
                                            $locates = ($locates == null) ? null : $locates;
                                            if ($locates != null) {
                                                $i = 1;
                                                foreach ($locates as $lc) {
                                                    ?>
                                                    <div>Địa chỉ <?=
                                                        $i . ': ' . $lc;
                                                        $i++;
                                                        ?></div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>Khóa học trọng tâm</td>
                                        <td><?php echo get_post_meta(get_the_ID(), 'center-main', true) ?></td>
                                    </tr>
                                    <tr class="">
                                        <td class="cl1">CEO</td>
                                        <td><?php echo get_post_meta(get_the_ID(), 'center-ceo', true); ?></td>
                                    </tr>
                                </table>

                                <div class="btn-group point">
                                    <button type="button" class="btn btn-default">Chấm điểm</button>
                                    <button type="button" class="btn btn-success number"><?php echo 2 * cal_rate(get_the_ID()); ?></button>
                                </div>
                            </div>
                        </div>
                        <!-- end post -->

                        <div class="tabs">
                            <div role="tabpanel">
                                <ul class="nav nav-tabs tablist" role="tablist">
                                    <li class="active" role="presentation" class="active">
                                        <a href="#description" aria-control="description" role="tab" data-toggle="tab">Thông tin chi tiết</a>         
                                    </li>
                                    <li class="" role="presentation">
                                        <a href="#courses" aria-control="description" role="tab" data-toggle="tab">Các khóa học</a>         
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="description">

                                    <?php the_content() ?>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="courses">
                                    <h3>Danh sách khóa học</h3>
                                    <?php query_posts(array('post_type' => 'course', 'meta_key' => 'eng-center-id', 'meta_value' => get_the_ID(), 'posts_per_page'=>5)); ?>
                                    <div class="posts">
                                        <?php if (have_posts()): while (have_posts()): the_post(); ?>
                                                <div class="post row">
                                                    <div class="col-xs-3 col-md-4 col-lg-2">
                                                        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail() ?></a>
                                                    </div>
                                                    <div class="col-xs-9 col-md-8 col-lg-6 post-content">
                                                        <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                        <p class="hidden-xs hidden-sm">
                                                            <?php echo short_desc(get_the_ID(), 65) ?>
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
                                                                <td class="info"><?= wp_trim_words(get_post_meta(get_the_ID(), 'course-time', true), 2); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="lb">Địa điểm</td>
                                                                <td class="info"><?php
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
                                                <hr class="clearfix" />
                                                <?php
                                            endwhile;
                                            wp_reset_query();
                                            ?>

                                            <script>
                                                jQuery(document).ready(function () {
                                                    var page = parseInt('<?php echo (get_query_var('paged') == 0) ? 1 : get_query_var('paged'); ?>');

                                                    jQuery('#post-load-more').click(function (e) {
                                                        e.preventDefault();
                                                        jQuery('#load_icon').fadeIn(100);
                                                        jQuery.ajax({
                                                            url: '<?php echo admin_url('admin-ajax.php') ?>',
                                                            type: 'POST',
                                                            data: {
                                                                action: 'load_more_post_eng_id',
                                                                page: page,
                                                                eng_id: jQuery(this).attr('eng-id')
                                                            },
                                                            success: function (data) {
                                                                jQuery('#courses .posts').append(data);
                                                                jQuery('#load_icon').fadeOut(200);
                                                            }
                                                        });
                                                        page = page + 1;
                                                    });
                                                });
                                            </script>

                                        <?php else:
                                            ?>
                                            <h3>Không có bài viết nào</h3>
                                        <?php endif; ?>

                                        <div class="clearfix"></div>
                                    </div>
                                    <?php global $wp_query;
                                    if($wp_query->found_posts > 5 ){ ?>
                                    <a href="#" id="post-load-more" eng-id="<?= get_the_ID() ?>" class="btn btn-success">Xem Thêm</a> <img id="load_icon" src="<?php echo get_template_directory_uri() ?>/assets/images/load.gif" width="50" height="50" />
                                    <?php } ?>
                                </div>
                            </div>


                            <div role="tabpanel">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#reviews" aria-control="reviews" role="tab" data-toggle="tab">Đánh giá</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#facebook_comments" aria-control="facebook_comments" role="tab" data-toggle="tab" >Facebook</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">

                                <div role="tabpanel" class="tab-pane fade in active" id="reviews">
                                    
                                    <?php comments_template(); ?>

                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="facebook_comments">
                                    <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_query();
                else:
                    ?>
                    <h3>Không có bài viết nào</h3>
                <?php endif; ?>
            </div>
            <?php get_sidebar('left'); ?>
        </div>
    </div>
</div>
<!-- end main -->

<?php get_footer(); ?>

