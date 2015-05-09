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
                    
                    
                    
                    <div class="row posts news-items">
                        <?php while(have_posts()): the_post(); ?>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 post">
                                <div class="news-item">
                                    <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                                    <div class="time">Thứ 2, ngày 29 tháng 11 năm 2015</div>
                                    <div class="new-thumbnail">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                    <p>
                                        <?php echo short_desc(get_the_ID(), 30);?>
                                    </p>
                                    <div class="row">
                                        <div class="col-sm-6 pull-left">
                                            <a href="<?php the_permalink() ?>" class="read-more btn btn-success btn-sm">Xem thêm</a>
                                        </div>
                                        <div class="col-sm-6 views pull-right text-right">
                                            <span class="number"><?php echo getPostViews(get_the_ID()); ?> </span> <img class="viewimg" src="<?php bloginfo('template_directory') ?>/assets/images/body/icon-13.png" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        
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