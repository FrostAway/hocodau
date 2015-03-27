<?php
/*
 * Template Name: English Club 
 */
?>
<?php get_header(); ?>

<div id="main">
    <div class="main-bg"></div>
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 column-right">        
                <?php include_once 'includes/slide.php'; ?>
                
                <div class="main-box">
                    <div class="box-title">
                <?php 
                $args = array('post_type'=>'english-club', 'posts_per_page'=>10);
                if(isset($_GET['dia-diem'])){
                    $prov = $_GET['dia-diem'];
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'city-center',
                            'field' => 'term_id',
                            'terms' => $prov,
                        )
                    );
                }
                query_posts($args);
                ?>
	            
                        <h3><strong>Câu lạc bộ Tiếng Anh</strong></h3>  
                        
                        <div class="page">
                            <?php previous_posts_link('<img src="'.  get_template_directory_uri().'/assets/images/body/icon-07.png" />') ?>
                            <?php next_posts_link('<img src="'.  get_template_directory_uri().'/assets/images/body/icon-08.png" />') ?>
                        </div>
                    </div>
                    
                    <?php include_once 'includes/filte-local.php'; ?>
                    
                    <div class="posts">
                        <?php if(have_posts()): while(have_posts()): the_post(); ?>
                            <div class="post row">
                                <div class="col-sm-12 col-md-4 col-lg-2">
                                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail() ?></a>
                                </div>
                                <div class="col-sm-12 col-md-8 col-lg-5 post-content">
                                    <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <p>
                                        <?php echo short_desc(get_the_ID(), 65);?>
                                    </p>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-5 ">
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
                                </div>
                            </div>
                            <?php edit_post_link('Edit'); ?>
                            <hr class="clearfix" />
                        <?php endwhile; wp_reset_query(); else: ?>
                            <h3>Không có bài viết nào</h3>
                        <?php endif; ?>

                        <div class="clearfix"></div>
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

