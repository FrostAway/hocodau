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
                                <!--<img class="post-thumbnail img-responsive" src="<?php //bloginfo('template_directory')  ?>/assets/images/body/anh-trang-review-17.jpg" />-->
                                <?php
                                echo get_the_post_thumbnail(get_the_ID(), 'single', array(
                                    'class' => 'post-thumbnail img-responsive'
                                ))
                                ?>
                            </div>
                            <div class="col-sm-12 col-lg-7 content">
                                <h3 class="content-title"><?php the_title(); ?></h3>
                                <div class="time"><?php the_time('l') ?>, ngày <?php the_time('d') ?> tháng <?php the_time('m') ?> năm <?php the_time('Y') ?></div>

                                <?php the_content(); ?>
                            </div>
                        </div>
                        <!-- end post -->

                        <div class="tabs">
                            <div role="tabpanel">
                                <ul class="nav nav-tabs tablist" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#reviews" aria-control="reviews" role="tab" data-toggle="tab">Bình luận</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="reviews">
                                    <!--<div class="fb-comments" data-href="<?php //the_permalink(); ?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>-->
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