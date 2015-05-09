<?php
/*
 * Template Name: English Center 
 */
?>
<?php get_header(); ?>

<div id="main">
    <div class="main-bg"></div>
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 column-right"> 

                <div class="main-box">
                    <div class="box-title">
                        <?php
                        $args = array('post_type' => 'english-center', 'posts_per_page' => 10, 'paged' => ( get_query_var('paged') ) ? get_query_var('paged') : 1);
                        if (isset($_GET['dia-diem']) && $_GET['dia-diem']!='') {
                            $prov = $_GET['dia-diem'];
                            $prov = split('-', $prov)[1];
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

                        <h3><strong>Trung tâm Tiếng Anh</strong></h3> 

                        <div class="page">
                            <?php previous_posts_link('<img src="' . get_template_directory_uri() . '/assets/images/body/icon-07.png" />') ?>
                            <?php next_posts_link('<img src="' . get_template_directory_uri() . '/assets/images/body/icon-08.png" />') ?>
                        </div>
                    </div>


                    <div class="bar-filter">
                        <div class="row">
                            <form class="" id="filter-form" method="get" action="">

                                <div class="col-sm-12 col-lg-3">
                                    <?php include_once 'filter/location.php'; ?>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-lg-1">
                                    <div class="form-group">
                                        <label class="control-label"> Tìm</label>
                                        <div><input class="btn btn-success" type="submit" value="Lọc" /></div>
                                    </div>
                                </div>
                                <!--<input type="hidden" name="filter-submit" value="filter-submit" />-->
                                <div class="col-xs-6 col-sm-6 col-lg-1">
                                    <?php
                                    global $wp;
                                    $current_url = home_url(add_query_arg(array(), $wp->request))
                                    ?>
                                    <label class="control-label">Bỏ</label>
                                    <div class="form-group">
                                        <a class="btn btn-danger" href="<?php echo $current_url ?>">Xóa</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="posts">
                        <?php if (have_posts()): while (have_posts()): the_post(); ?>
                                <div class="post row">
                                    <div class="col-xs-3 col-md-4 col-lg-2">
                                        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail() ?></a>
                                    </div>
                                    <div class="col-xs-9 col-md-8 col-lg-5 post-content">
                                        <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        <p class="hidden-xs hidden-sm">
                                            <?php echo short_desc(get_the_ID(), 65); ?>
                                        </p>
                                    </div>
                                    <div class="col-xs-12 col-md-12 col-lg-5 ">
                                        <table class="post-info">
                                            <tr>
                                                <?php if (get_post_meta(get_the_ID(), 'center-ceo', true) != '') { ?>
                                                    <td class="lb">CEO</td>
                                                    <td class="info"><?= get_post_meta(get_the_ID(), 'center-ceo', true); ?></td>
                                                <?php } ?>
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
                                                <td class="lb">Khóa học trọng tâm</td>
                                                <td class="info"><?= get_post_meta(get_the_ID(), 'center-main', true); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="lb">Địa điểm</td>
                                                <td class="info">
                                                    <?php
                                                    $terms = get_the_terms(get_the_ID(), 'city-center');
                                                    if ($terms)
                                                        foreach ($terms as $term) {
                                                            echo '<div>' . $term->name . '</div>';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <?php edit_post_link("Edit"); ?>
                                <hr class="clearfix" />
                            <?php endwhile; ?>

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

                            <?php
                            wp_reset_query();
                        else:
                            ?>
                            <h3>Không có bài viết nào</h3>
<?php endif; ?>

                        <div class="clearfix"></div>
                        <div class="paging">

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