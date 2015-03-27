<?php get_header(); ?>

<?php setPostViews(get_the_ID()) ?>
<div id="main">
    <div class="main-bg"></div>
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 column-right">                       

                <?php if (have_posts()): while (have_posts()): the_post(); ?>
                
                        <div id="post" class="clearfix">
                            <?php the_breadcrumb(); ?>

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
                                                        <strong class="num"><?= cal_rate(get_the_ID())  ?></strong> trên 5			
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="lb">Giá</td>
                                        <td class="price"><?php echo unit(get_post_meta(get_the_ID(), 'course-price', true)); ?></td>
                                    </tr>
                                    <tr class="">
                                        <td>Thời gian</td>
                                        <td><?php echo get_post_meta(get_the_ID(), 'course-time', true) ?></td>
                                    </tr>
                                    <tr class="">
                                        <td class="cl1">Địa điểm</td>
                                        <td><?php echo get_post_meta(get_the_ID(), 'course-location', true); ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="cl1">Lịch học</td>
                                        <td><?php echo get_post_meta(get_the_ID(), 'course-cons', true) ?></td>
                                    </tr>
                                    
                                </table>

                                <div class="btn-group point">
                                    <button type="button" class="btn btn-default">Chấm điểm</button>
                                    <button type="button" class="btn btn-success number"><?php echo 2 * cal_rate(get_the_ID()); ?></button>
                                </div>
								
								<div style="margin-top: 20px;" class="fb-like" data-href="<?php echo get_post_permalink();  ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
								
                            </div>
                        </div>
                        <!-- end post -->

                        <div class="tabs">
                            <div role="tabpanel">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#description" aria-control="description" role="tab" data-toggle="tab">Chi tiết khóa học</a>         
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div role="tabpanel" class="" id="description">
                                    
                                    <p>
                                        <?php the_content(); ?>
                                    </p>
                                </div>
                            </div>
                            <div role="tabpanel">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#reviews" aria-control="reviews" role="tab" data-toggle="tab">Đánh giá</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                
                                <div role="tabpanel" class="" id="reviews">
                                    <!--<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>-->
                                    
                                    <?php comments_template(); ?>
                                    
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                            else: ?>
                    <h3>Không có bài viết nào</h3>
                    <?php endif; ?>
            </div>
            
            
            <?php get_sidebar('left'); ?>

        </div>
    </div>
</div>
<!-- end main -->

<?php get_footer(); ?>