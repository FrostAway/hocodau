<?php get_header(); ?>

<div id="main">
    <div class="main-bg"></div>
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 column-right">                       

                <div class="main-box">
                    <div class="box-title">
                        <?php
                        global $wp_query;
                        $term = $wp_query->get_queried_object();
                        $title = $term->name;
                        ?>

                        <h1><strong><?php echo $title; ?></strong></h1> 

                        <div class="page">
                            <?php previous_posts_link('<img src="' . get_template_directory_uri() . '/assets/images/body/icon-07.png" />') ?>
                            <?php next_posts_link('<img src="' . get_template_directory_uri() . '/assets/images/body/icon-08.png" />') ?>
                        </div>
                    </div>

                    <?php include_once 'filter/filter_bar.php'; ?>

                    <div class="posts">
                        <?php include_once 'template/course_loop.php'; ?>
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
<?php // previous_posts_link('<img title="Trước" src="'.  get_template_directory_uri().'/assets/images/body/icon-07.png" />')    ?>
<?php // next_posts_link('<img title="Sau" src="'.  get_template_directory_uri().'/assets/images/body/icon-08.png" />')   ?>
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