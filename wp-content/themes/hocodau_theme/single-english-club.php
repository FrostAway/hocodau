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
                                                        <strong class="num"><?= cal_rate(get_the_ID()) ?></strong> trên 5			
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="lb">Địa điểm</td>
                                        <td class="info"><?php echo get_post_meta(get_the_ID(), 'clb-location', true); ?></td>
                                    </tr>
                                    <tr class="">
                                        <td>Thành lập</td>
                                        <td><?php echo get_post_meta(get_the_ID(), 'clb-estab', true) ?></td>
                                    </tr>
                                    <tr class="">
                                        <td>Số lượng thành viên</td>
                                        <td><?php echo get_post_meta(get_the_ID(), 'clb-number', true) ?></td>
                                    </tr>
                                    <tr class="">
                                        <td>Thời gian sinh hoạt</td>
                                        <td><?php echo get_post_meta(get_the_ID(), 'clb-active', true) ?></td>
                                    </tr>
                                    <tr class="">
                                        <td>Đối tượng</td>
                                        <td><?php echo get_post_meta(get_the_ID(), 'clb-obj', true) ?></td>
                                    </tr>
                                </table>

                                <div class="btn-group point">
                                    <button type="button" class="btn btn-default">Chấm điểm</button>
                                    <button type="button" class="btn btn-success number"><?php echo cal_rate(get_the_ID()) * 2; ?></button>
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
                                        <a href="#event" aria-control="description" role="tab" data-toggle="tab">Sự kiện</a>         
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="description">
                                    
                                    <p>
                                        <?php the_content(); ?>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="event">
                                    <h3>Danh sách sự kiện</h3>
                                    <?php query_posts(array('post_type'=>'event', 'meta_key'=>'club-id', 'meta_value'=>  get_the_ID())); ?>
                                    <div class="posts">
                                        <?php if (have_posts()): while (have_posts()): the_post(); ?>
                                                <div class="post row">
                                <div class="col-sm-12 col-md-4 col-lg-2">
                                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail() ?></a>
                                </div>
                                <div class="col-sm-12 col-md-8 col-lg-6 post-content">
                                    <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <p class="hidden-xs hidden-sm">
                                        <?php echo short_desc(get_the_ID(), 60); ?>
                                    </p>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4 ">
                                    <table class="post-info">
                                        <tr>
                                            <td class="lb ">- Mức phí</td>
                                            <td class="info price"><?= unit(get_post_meta(get_the_ID(), 'event-price', true)); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="lb">- Đánh giá</td>
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
                                            <td class="lb">- Đối tượng tham gia</td>
                                            <td class="info"><?= get_post_meta(get_the_ID(), 'event-obj', true); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="lb">- Thời gian</td>
                                            <td class="info"><?= get_post_meta(get_the_ID(), 'event-time', true); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="lb">- Địa điểm</td>
                                            <td class="info"><?= get_post_meta(get_the_ID(), 'event-location', true); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <hr class="clearfix" />
                                            <?php endwhile;
                                            wp_reset_query();
                                        else: ?>
                                            <h3>Không có bài viết nào</h3>
                                        <?php endif; ?>

                                        <div class="clearfix"></div>
                                    </div>

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
                                    <!--<div class="fb-comments" data-href="<?php //the_permalink(); ?>" data-width="775" data-numposts="5" data-colorscheme="light"></div>-->
                                    <?php comments_template(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
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

