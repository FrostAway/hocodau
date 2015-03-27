<?php get_header(); ?>

<div id="main">
    <div class="main-bg"></div>
    <div class="container">
        <div class="row">
            
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 column-right">                       
                               
                <div class="main-box">
                    <div class="box-title">
                <?php global $wp_query;
                        $term = $wp_query->get_queried_object();
                        $title = $term->name; ?>
                        
                        <h3><strong><?php echo $title; ?></strong></h3> 
                        
                        <div class="page">
                            <?php previous_posts_link('<img src="'.  get_template_directory_uri().'/assets/images/body/icon-07.png" />') ?>
                            <?php next_posts_link('<img src="'.  get_template_directory_uri().'/assets/images/body/icon-08.png" />') ?>
                        </div>
                    </div>
                    
                    <?php include_once 'includes/filter.php'; ?>
                    
                    <div class="posts">
                        <?php if(have_posts()): while(have_posts()): the_post(); ?>
                            <div class="post row">
                                <div class="col-sm-12 col-md-4 col-lg-2">
                                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail() ?></a>
                                </div>
                                <div class="col-sm-12 col-md-8 col-lg-7 post-content">
                                    <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <p>
                                        <?php echo short_desc(get_the_ID(), 65)?>
                                    </p>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-3 ">
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
                                                            <strong class="num"><?= cal_rate(get_the_ID()) ?> ?></strong> trên 5			
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
                        <div class="paging">
                            <?php previous_posts_link('<img src="'.  get_template_directory_uri().'/assets/images/body/icon-07.png" />') ?>
                            <?php next_posts_link('<img src="'.  get_template_directory_uri().'/assets/images/body/icon-08.png" />') ?>
                        </div>
                    </div>
                </div>
                <!-- end main box -->
            </div>
            <?php get_sidebar('left') ?>
        </div>
    </div>
</div>
<!-- end main -->
			


<?php get_footer(); ?>