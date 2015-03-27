<?php get_header(); ?>

<div id="main">
    <div class="main-bg"></div>
    <div class="container">
        <div class="row">
            
            
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 column-right">                       
                <?php include_once 'includes/slide.php'; ?>
                
                
                <div class="main-box">
                    <?php
                    $query_new = array('post_type'=>'course', 'showposts'=>8, 'orderby'=>'post_date', 'order'=>'DESC');
                    if (isset($_GET['gia'])) {
                            $price = $_GET['gia'];
                            $splprice = split("-", $price);
                            if (count($splprice) > 1) {
                                $metaquery = array(
                                    array(
                                        'key' => 'course-price',
                                        'value' => $splprice,
                                        'type' => 'numeric',
                                        'compare' => 'BETWEEN'
                                    )
                                );
                            } else {
                                $metaquery = array(
                                    array(
                                        'key' => 'course-price',
                                        'value' => $price,
                                        'type' => 'numeric',
                                        'compare' => '>'
                                    )
                                );
                            }
                            $query_new['meta_query'] = $metaquery;
                        }

                        if (isset($_GET['dau-vao'])) {
                            $dv = $_GET['dau-vao'];
                            $dv = split("-", $dv)[1];
                            $query_new['meta_query'] = array(
                                array(
                                    'key' => 'course-input',
                                    'value' => $dv,
                                    'type' => 'numeric',
                                    'compare' => '='
                                )
                            );
                        }
                        if (isset($_GET['dia-diem'])) {
                            $prov = $_GET['dia-diem'];
                            $query_new['tax_query'] = array(
                                array(
                                    'taxonomy' => 'city-center',
                                    'field' => 'term',
                                    'terms' => array($prov),
                                    'operator' => 'IN'
                                )
                            );
                        }

                        if (isset($_GET['time'])) {
                            $tget = $_GET['time'];
                            $query_new['meta_query'] = array(
                                array(
                                    'key' => 'course-month',
                                    'value' => $tget,
                                    'type' => 'numeric',
                                    'compare' => '='
                                )
                            );
                        }
                        
                    query_posts($query_new); 
                    ?>
                    <div class="box-title">
                        <h3><strong>Khóa học trong thời gian tới</strong></h3>
                        <div class="page">
                            <a href="<?= get_term_link(27, 'course-cat') ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/images/body/icon-08.png" /></a>
                        </div>
                    </div>
                    <?php include_once 'includes/filter.php'; ?>
                    <div class="posts">
                        <?php if(have_posts()): while(have_posts()): the_post(); ?>
                            <div class="post row">
                                <div class="col-sm-12 col-md-4 col-lg-2">
                                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail() ?></a>
                                </div>
                                <div class="col-sm-12 col-md-8 col-lg-6 post-content">
                                    <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <p>
                                        <?php echo short_desc(get_the_ID(), 65);?>
                                    </p>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4 ">
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
                                        <tr>
                                            <td class="lb">Thời gian</td>
                                            <td class="info"><?= get_post_meta(get_the_ID(), 'course-time', true); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="lb">Địa điểm</td>
                                            <td class="info"><?= get_post_meta(get_the_ID(), 'course-location', true); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        <?php edit_post_link("Edit"); ?>
                            <hr class="clearfix" />
                        <?php endwhile; wp_reset_query(); else: ?>
                            <h3>Không có bài viết nào</h3>
                        <?php endif; ?>

                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- end main box -->
                
                <div class="main-box">
                    <?php 
                    $query_hot = array('post_type'=>'course', 'showposts'=>8, 'meta_key'=>'course-featured', 'meta_value'=>'on');
                    query_posts($query_hot) 
                    ?>
                    <div class="box-title">
                        <h3><strong>Khóa học đang hot</strong></h3>
                        <div class="page">
                            <a href="<?= get_term_link(27, 'course-cat') ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/images/body/icon-08.png" /></a>
                        </div>
                    </div>
						
                    <div class="posts">
                        <?php if(have_posts()): while(have_posts()): the_post(); ?>
                            <div class="post row">
                                <div class="col-sm-12 col-md-4 col-lg-2">
                                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail() ?></a>
                                </div>
                                <div class="col-sm-12 col-md-8 col-lg-6 post-content">
                                    <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <p>
                                        <?php echo short_desc(get_the_excerpt(), 60); ?>
                                    </p>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4 ">
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
                                        <tr>
                                            <td class="lb">Thời gian</td>
                                            <td class="info"><?= get_post_meta(get_the_ID(), 'course-time', true); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="lb">Địa điểm</td>
                                            <td class="info"><?= get_post_meta(get_the_ID(), 'course-location', true); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <?php edit_post_link("Edit"); ?>
                            <hr class="clearfix" />
                        <?php endwhile; wp_reset_query(); else: ?>
                            <h3>Không có bài viết nào</h3>
                        <?php endif; ?>

                        <div class="clearfix"></div>
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
        <h3><a href="<?php echo get_category_link(1) ?>">Tin tức</a></h3>
        <div class="row news-items">
            <?php query_posts(array('post_type'=>'post', 'showposts'=>4, 'cat'=>1)); ?>
            <?php if(have_posts()): while(have_posts()): the_post(); ?>
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
            <?php endwhile; wp_reset_query(); else: ?>
            <h3>Không có bài viết nào</h3>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- end news -->


<?php get_footer(); ?>