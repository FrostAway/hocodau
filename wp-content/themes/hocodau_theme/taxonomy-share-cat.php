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
                    
                    
                    
                    <div class="posts">
                        <?php if(have_posts()): while(have_posts()): the_post(); ?>
                            <div class="post row">
                                <div class="col-xs-3 col-md-4 col-lg-3">
                                    <a href="<?php the_permalink() ?>">
									<?php if(has_post_thumbnail()){?>
									<?php the_post_thumbnail() ?>
									<?php }else{?>
									<img class="img-responsive" src="<?php echo get_template_directory_uri() ?>/assets/images/default-thumb.png" />
									<?php } ?>
									</a>
                                </div>
                                <div class="col-xs-9 col-md-8 col-lg-9 post-content">
                                    <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <p class="hidden-xs hidden-sm">
                                        <?php echo short_desc(get_the_ID(), 65)?>
                                    </p>
                                </div>
                            </div>
                        <?php edit_post_link("Edit"); ?>
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
                        <div class="paging">
                            <?php // previous_posts_link('<img title="Trước" src="'.  get_template_directory_uri().'/assets/images/body/icon-07.png" />') ?>
                            <?php // next_posts_link('<img title="Sau" src="'.  get_template_directory_uri().'/assets/images/body/icon-08.png" />') ?>
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