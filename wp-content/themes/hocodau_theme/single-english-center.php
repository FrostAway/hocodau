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
                                echo get_the_post_thumbnail(get_the_ID(), 'thumb_single', array(
                                    'class' => 'post-thumbnail img-responsive'
                                ))
                                ?>
                            </div>
                            <div class="col-sm-12 col-lg-7 content">
                                <h1 class="content-title"><?php the_title(); ?></h1>
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
                                            if($locates != null){ $i=1;
                                                foreach ($locates as $lc){ ?>
                                            <div>Địa chỉ <?= $i.': '.$lc; $i++; ?></div>
                                                <?php }
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
                                    <?php query_posts(array('post_type'=>'course', 'meta_key'=>'eng-center-id', 'posts_per_page'=>5, 'meta_value'=>  get_the_ID())); ?>
                                    <div class="posts">
                                        <?php include_once 'template/course_loop.php'; ?>
                                    </div>
                                    
                                    <a href="#" id="post-load-more" eng-id="<?= get_the_ID() ?>" class="btn btn-success">Xem Thêm</a> <img id="load_icon" src="<?php echo get_template_directory_uri() ?>/assets/images/load.gif" width="50" height="50" />
                                    
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
                    <?php endwhile; wp_reset_query();
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

