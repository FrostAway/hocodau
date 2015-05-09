<?php get_header(); ?>

<div id="main">
    <div class="main-bg"></div>
    <div class="container">
        <div class="row">

            

            <div class="col-sm-12 col-md-8 col-lg-9 column-right">                       
                               
                <div class="main-box">
                    <div class="box-title">
		<?php if (have_posts()) : ?>
                       
                        <h3><strong>Kết quả tìm kiếm <i>'<?php echo $s; ?>'</i></strong></h3> 
                        
                        <div class="page">
                            <?php previous_posts_link('<img src="'.  get_template_directory_uri().'/assets/images/body/icon-07.png" />') ?>
                            <?php next_posts_link('<img src="'.  get_template_directory_uri().'/assets/images/body/icon-08.png" />') ?>
                        </div>
                    </div>
                    
                    <?php include_once 'filter/filter_bar.php'; ?>
                    
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
                                    <?php if(get_post_type() == 'course'){ ?>
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
                                    <?php }elseif(get_post_type() == 'english-center' ){ ?>
                                    <table class="post-info">
                                        <tr>
                                            <td class="lb">CEO</td>
                                            <td class="info"><?= get_post_meta(get_the_ID(), 'center-ceo', true); ?></td>
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
                                            <td class="lb">Khóa học trọng tâm</td>
                                            <td class="info"><?= get_post_meta(get_the_ID(), 'center-main', true); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="lb">Địa điểm</td>
                                            <td class="info"><?= get_post_meta(get_the_ID(), 'center-location', true); ?></td>
                                        </tr>
                                    </table>
                                    <?php }elseif(get_post_type() == 'english-club'){ ?>
                                    <table class="post-info">
                                        <tr>
                                            <td class="lb">Đối tượng</td>
                                            <td class="info"><?= get_post_meta(get_the_ID(), 'clb-obj', true); ?></td>
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
                                            <td class="lb">Thành lập</td>
                                            <td class="info"><?= get_post_meta(get_the_ID(), 'clb-estab', true); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="lb">Số lượng thành viên</td>
                                            <td class="info"><?= get_post_meta(get_the_ID(), 'clb-number', true); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="lb">Thời gian sinh hoạt</td>
                                            <td class="info"><?= get_post_meta(get_the_ID(), 'clb-active', true); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="lb">Địa điểm</td>
                                            <td class="info"><?= get_post_meta(get_the_ID(), 'clb-location', true); ?></td>
                                        </tr>
                                    </table>
                                    <?php } ?>
                                </div>
                            </div>
                            <hr class="clearfix" />
                        <?php endwhile; wp_reset_query(); else: ?>
                            <h3>Không có bài viết nào</h3>
                        <?php endif; ?>

                        <div class="clearfix"></div>
                        <div class="pagination">
                                <?php
                                global $wp_query;

                                $big = 999999999; // need an unlikely integer

                                echo paginate_links(array(
                                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                                    'format' => '?paged=%#%',
                                    'current' => ( get_query_var('paged') ) ? get_query_var('paged') : 1,
                                    'total' => $wp_query->max_num_pages
                                ));
                                ?>
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
			
			
	<?php else : ?>

		<h3><strong>Nothing found</strong></h3>

	<?php endif; ?>



<?php get_footer(); ?>