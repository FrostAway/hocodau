<?php get_header(); ?>

<div id="main">
    <div class="main-bg"></div>
    <div class="container">
        <div class="row">


            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 column-right">                       
                <?php include_once 'includes/slide.php'; ?>

                <div class="main-box">
                    <?php
                    $query_new = array('post_type' => 'course', 'showposts' => 8, 'orderby' => 'post_date', 'order' => 'DESC');
                    $metaquery = array();
                    $taxquery = array();
                    if (isset($_GET['muc-gia']) && $_GET['muc-gia'] != '') {
                        $price = $_GET['muc-gia'];
                        $splprice = split("-", $price);
                        if (count($splprice) > 1) {
                            $metaquery[] = array(
                                'key' => 'course-price',
                                'value' => $splprice,
                                'type' => 'numeric',
                                'compare' => 'BETWEEN'
                            );
                        } else {
                            $metaquery[] = array(
                                'key' => 'course-price',
                                'value' => $price,
                                'type' => 'numeric',
                                'compare' => '>'
                            );
                        }
                    }

                    if (isset($_GET['dau-vao']) && $_GET['dau-vao'] != '') {
                        $dv = $_GET['dau-vao'];
                        $dv = split("-", $dv)[1];
                        $metaquery[] = array(
                            'key' => 'course-input',
                            'value' => $dv,
                            'type' => 'numeric',
                            'compare' => '='
                                )
                        ;
                    }

                    if (isset($_GET['dia-diem']) && $_GET['dia-diem'] != '') {
                        $prov = $_GET['dia-diem'];
                        $prov = split('-', $prov)[1];
                        $taxquery[] = array(
                            'taxonomy' => 'city-center',
                            'field' => 'term',
                            'terms' => array($prov),
                            'operator' => 'IN'
                        );
                    }

                    if (isset($_GET['thoi-gian'])) {
                        $tget = $_GET['thoi-gian'];
                        $tget = split('-', $tget)[1];
                        $metaquery[] = array(
                            'key' => 'course-month',
                            'value' => $tget,
                            'type' => 'numeric',
                            'compare' => '='
                        );
                    }
                    $query_new['meta_query'] = $metaquery;
                    $query_new['tax_query'] = $taxquery;

                    query_posts($query_new);
                    ?>
                    <div class="box-title">
                        <h3><a href="<?= get_term_link(27, 'course-cat') ?>"><strong>Tất cả khóa học</strong></a></h3>
                        <div class="page">
                            <a href="<?= get_term_link(27, 'course-cat') ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/images/body/icon-08.png" /></a>
                        </div>
                    </div>
                    <?php // include_once 'includes/filter.php'; ?>
                    <?php include_once 'filter/filter_bar.php'; ?>
                    <div class="posts" id="list-post-append">
                        <?php include 'template/course_loop.php'; ?>
                    </div>
                    <a href="#" id="post-load-more" class="btn btn-success">Xem Thêm</a> <img id="load_icon" src="<?php echo get_template_directory_uri() ?>/assets/images/load.gif" width="50" height="50" />
                </div>
                <!-- end main box -->

                <div class="main-box">
                    <?php
                    $query_hot = array('post_type' => 'course', 'showposts' => 8, 'meta_key' => 'course-featured', 'meta_value' => 'on');
                    query_posts($query_hot)
                    ?>
                    <div class="box-title">
                        <h3><strong>Khóa học đang hot</strong></h3>
                        <div class="page">
                            <a href="<?= get_term_link(27, 'course-cat') ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/images/body/icon-08.png" /></a>
                        </div>
                    </div>

                    <div class="posts">
                        <?php include 'template/course_loop.php' ?>
                    </div>
                </div>
                <!-- end main box -->
            </div>

            <?php get_sidebar('left'); ?>

        </div>
    </div>
</div>
<!-- end main -->

<div id="news">
    <div class="container">
        <h3><a href="<?php echo get_category_link(1) ?>">Sự kiện</a></h3>
        <div class="row news-items">
            <?php query_posts(array('post_type' => 'post', 'showposts' => 4, 'cat' => 1)); ?>
            <?php if (have_posts()): while (have_posts()): the_post(); ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="news-item">
                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <div class="time"><?php the_time('l') ?>, ngày <?php the_time('d') ?> tháng <?php the_time('m') ?> năm <?php the_time('Y') ?></div>
                            <div class="new-thumbnail">
                                <?php the_post_thumbnail(); ?>
                            </div>
                            <p>
                                <?php echo get_the_content(); ?>
                            </p>
                            <div class="row">
                                <div class="col-sm-6 pull-left">
                                    <a href="<?php the_permalink() ?>" class="read-more btn btn-success">Xem thêm</a>
                                </div>
                                <div class="col-sm-4  views pull-right">
                                    <span class="number"><?php echo getPostViews(get_the_ID()); ?> </span> <img class="viewimg" src="<?php bloginfo('template_directory') ?>/assets/images/body/icon-13.png" />
                                </div>
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
    </div>
</div>
<!-- end news -->


<?php get_footer(); ?>