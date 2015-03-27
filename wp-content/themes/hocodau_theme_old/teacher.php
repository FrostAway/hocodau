<?php
/*
 * Template Name: English Teacher 
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
                $args = array('post_type'=>'teacher', 'posts_per_page'=>10);
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
                if(isset($_GET['tuoi'])){
                    $tuoi = $_GET['tuoi'];
                    $spltuoi = split("-", $tuoi);
                    if (count($spltuoi) > 1) {
                    $metaquery = array(
                        array(
                            'key' => 'tc-age',
                            'value' => $spltuoi,
                            'type' => 'numeric',
                            'compare' => 'BETWEEN'
                        )
                    );
                    $args['meta_query'] = $metaquery;
                } else {
                    $metaquery = array(
                        array(
                            'key' => 'tc-age',
                            'value' => $tuoi,
                            'type' => 'numeric',
                            'compare' => '>'
                        )
                    );
                    $args['meta_query'] = $metaquery;
                }
                }
                
                if(isset($_GET['giangvien'])){
                    $gv = split('-', $_GET['giangvien'])[1];
                    $args['meta_query'] = array(
                        array(
                            'key' => 'tc-cat',
                            'value' => $gv,
                            'type' => 'numeric',
                            'compare' => '='
                        )
                    );
                }
                query_posts($args);
                ?>
	            
                        <h3><strong>Giảng viên Tiếng Anh</strong></h3>  
                        
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
                                        <?php short_desc(get_the_ID(), 65) ?>
                                    </p>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-5 ">
                                    <table class="post-info">
                                        <tr>
                                            <td class="lb">Địa điểm Lớp học</td>
                                            <td class="info"><?= get_post_meta(get_the_ID(), 'tc-cl-location', true); ?></td>
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
                                            <td class="lb">Kinh nghiệm</td>
                                            <td class="info"><?= get_post_meta(get_the_ID(), 'tc-exp', true); ?></td>
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
            
            
            <?php get_sidebar('left') ?>

        </div>
    </div>
</div>
<!-- end main -->

<?php get_footer(); ?>

