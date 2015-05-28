<?php if (have_posts()): while (have_posts()): the_post(); ?>
        <div class="post row">
            <div class="col-xs-3 col-md-4 col-lg-2">
                <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('thumb_small') ?></a>
            </div>
            <div class="col-xs-9 col-md-8 col-lg-4 post-content">
                <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <p class="hidden-xs hidden-sm">
                    <?php echo short_desc(get_the_ID(), 50) ?>
                </p>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-3 course-time">
                <div class="show-course-time">
                    <h4>Thời gian</h4>
                    <?php
                    $course_cals = unserialize(get_post_meta(get_the_ID(), 'course-calendar', true));
                    if (is_array($course_cals) && count($course_cals) > 0) {
                        ?>
                        <table class="post-info">
                            <?php foreach ($course_cals as $key => $cal) {
                                ?>

                                <tr><th class="lb" style="white-space: nowrap;"><?php echo 'Địa chỉ ' . ($key + 1) ?></th><td><div><?php echo $cal; ?></div></td></tr>
                                <?php
                            }
                            ?>
                        </table>  
                    <?php }
                    ?>
                </div>
        <!--                                        <script>
                    $(function () {
                        $('.show-course-time').datepicker({
                            dateFormat: 'dd-mm-y'
                        }).datepicker('setDate', '13-05-15');
                    });
                </script>-->
            </div>
            <div class="col-xs-12 col-md-6 col-lg-3 ">
                <table class="post-info">
                    <tr>
                        <td class="lb ">Giá</td>
                        <td class="info price"><?= unit(get_post_meta(get_the_ID(), 'course-price', true)); ?></td>
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
                    <tr class="">
                        <?php
                        $center_id = get_post_meta(get_the_ID(), 'eng-center-id', true);
                        if ($center_id != 0) {
                            ?>
                            <th class="lb">Trung tâm</th>
                            <td class="info"><a href="<?= get_permalink($center_id) ?>"><?= get_the_title($center_id) ?></a></td>
                        <?php } ?>
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
        <?php
    endwhile;
    wp_reset_query();
    ?>
    <script>
        jQuery(document).ready(function () {
            var page = parseInt('<?php echo (get_query_var('paged') == 0) ? 1 : get_query_var('paged'); ?>');

            jQuery('#post-load-more').click(function (e) {
                e.preventDefault();
                $('#load_icon').fadeIn(100);
                jQuery.ajax({
                    url: '<?php echo admin_url('admin-ajax.php') ?>',
                    type: 'POST',
                    data: {
                        action: 'load_more_post',
                        page: page
                    },
                    success: function (data) {
                        jQuery('#list-post-append').append(data);
                        $('#load_icon').fadeOut(200);
                    }
                });
                page = page + 1;
            });
        });
    </script>

<?php else:
    ?>
    <h3>Không có bài viết nào</h3>
<?php endif; ?>
<div class="clearfix"></div>