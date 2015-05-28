<?php get_header(); ?>

<div id="main">
    <div class="main-bg"></div>
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 column-right">                       
                <?php include_once 'includes/slide.php'; ?>
                
                <div class="main-box">
                    <div class="box-title">
                <?php wp_reset_postdata(); ?>
		<?php if (have_posts()) : ?>

 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

			<?php /* If this is a category archive */ if (is_category()) { ?>
				<h1><?php single_cat_title(); ?></h1>

			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<h1><?php single_tag_title(); ?></h1>

			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h1>Theo ngày <?php the_time('F jS, Y'); ?></h1>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h1>Theo ngày <?php the_time('F, Y'); ?></h1>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h1>Theo ngày <?php the_time('Y'); ?></h1>

			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h1>Author</h1>

			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h1>Blog</h1>
			
			<?php } ?>
                          
                        <div class="page">
                            <?php previous_posts_link('<img src="'.  get_template_directory_uri().'/assets/images/body/icon-07.png" />') ?>
                            <?php next_posts_link('<img src="'.  get_template_directory_uri().'/assets/images/body/icon-08.png" />') ?>
                        </div>
                    </div>
                     
                    <div class="row news-items">
                        <?php while(have_posts()): the_post(); ?>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="news-item">
                                    <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                                    <div class="time">Thứ 2, ngày 29 tháng 11 năm 2015</div>
                                    <div class="new-thumbnail">
                                        <?php the_post_thumbnail('thumb_small'); ?>
                                    </div>
                                    <p>
                                        <?php echo short_desc(get_the_ID(), 65);?>
                                    </p>
                                    <div class="row">
                                        <div class="col-sm-6 pull-left">
                                            <a href="<?php the_permalink() ?>" class="read-more btn btn-success">Xem thêm</a>
                                        </div>
                                        <div class="col-sm-6 views pull-right">
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
			
			
	<?php else : ?>

		<h1>Nothing found</h1>

	<?php endif; ?>



<?php get_footer(); ?>