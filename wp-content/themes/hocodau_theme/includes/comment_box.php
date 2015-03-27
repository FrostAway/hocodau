<?php
$comment_query = new WP_Comment_Query();
$comments = $comment_query->query(array(
    'post_id' => get_the_ID(),
    'meta_key' => 'comment-vote',
    'orderby' => 'meta_value',
        ));
?>
<ul class="list-unstyled reviews-list"> 
    <?php
    $index = 0;
    if (count($comments) > 0){
        foreach ($comments as $cm) {
            $index++;
            ?>
            <li style="<?php if ($index > 3) echo 'display: none'; ?>">
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-3 avatar">
                        <?php echo get_avatar($cm->comment_author_email) ?>
                        <h4 class="name"><?php echo $cm->comment_author ?></h4>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-9 comment">
                        <h4><a href="#">Xếp hạng</a></h4>
                        <div class="rating">
                            <div title="" class="star-rating">
                                <span>
                                    <strong class="num"><?php echo get_comment_meta($cm->comment_ID, 'rating', true); ?></strong> trên 5			
                                </span>
                            </div>
                        </div>
                        <p id="comment-<?php echo $cm->comment_ID ?>">
                            <?php echo wp_trim_words($cm->comment_content, 80, '... <a class="load-more-comment" href="'.$cm->comment_ID.'">Xem thêm</a>'); ?>
                        </p>
                        <?php if(is_user_logged_in()){ ?>
                        <?php if(wp_get_current_user()->user_login != $cm->comment_author){ ?>
                            <button style="margin-left: 20px;" class="btn btn-default btn-sm btn-vote-comment" data-user="<?= wp_get_current_user()->user_login; ?>" data-id="<?= $cm->comment_ID ?>" data-vote="<?= get_comment_meta($cm->comment_ID, 'comment-vote', true) ?>"><?= get_comment_meta($cm->comment_ID, 'comment-vote', true); ?> Vote</button>
                            <?php
                           $uservote = get_comment_meta($cm->comment_ID, 'user-vote', true);
                            $arr_user = split(' ', $uservote);
                            if(in_array(wp_get_current_user()->user_login, $arr_user)){
                                echo '<i>Đã vote</i>';
                            }
                            ?>
                        <?php }else{ ?>
                            <button style="margin-left: 20px;" class="btn btn-default btn-sm "><?= get_comment_meta($cm->comment_ID, 'comment-vote', true); ?> Vote</button>
                        <?php }}else{ ?>
                            <button style="margin-left: 20px;" class="btn btn-default btn-sm "><?= get_comment_meta($cm->comment_ID, 'comment-vote', true); ?> Vote</button>
                            <i>Đăng nhập để bình chọn</i>
                        <?php } ?>
                    </div>
                </div>
            </li>
    <?php } ?>
            <?php if($index >3){ ?>
            <li id="btn-load-comment"><div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <a href="#" id="comment-more" class="btn btn-default btn-block btn-sm">Xem thêm bình luận</a>
            </div>
        </div></li>
            <?php } }?>
            
</ul>

<form id="commentform" class="form-horizontal" method="post" action="<?php echo home_url() ?>/wp-comments-post.php">     
    <div class="review-star form-group">
        <label for="rating" class="col-sm-2">Đánh giá của bạn</label>
        <p class="stars col-sm-10">
            <span>
                <a href="#" class="star-1">1</a>
                <a href="#" class="star-2">2</a>
                <a href="#" class="star-3">3</a>
                <a href="#" class="star-4">4</a>
                <a href="#" class="star-5">5</a>
            </span>
        </p>
        <select id="rating" name="rating" style="display: none;">
            <option value="">Đánh giá…</option>
            <option value="5">Rất tốt</option>
            <option value="4">Tốt</option>
            <option value="3">Trung bình</option>
            <option value="2">Không tệ</option>
            <option value="1">Rất Xấu</option>
        </select>
    </div>
<?php if (!is_user_logged_in()) { ?>
        <div class="form-group">
            <label for="review-name" class="col-sm-2">Tên của bạn</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" aria-required="true" tabindex="1" value="" id="author" name="author">
            </div>
        </div>
        <div class="form-group">
            <label for="review-email" class="col-sm-2 ">Email</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" aria-required="true" tabindex="2" value="" id="email" name="email">
            </div>
        </div>
<?php } else { ?>
    <?php $user = wp_get_current_user(); ?>
        <h4>Bình luận với tài khoản: <a href="<?php echo get_author_posts_url($user->data->ID) ?>"><strong><?php echo $user->data->user_nicename ?></strong></a>  &gt;&gt; <a href="<?php echo wp_logout_url(get_the_permalink()) ?>">Đăng xuất</a></h4>
        <h4> </h4><br />
        <input class="form-control" type="hidden" aria-required="true" tabindex="1" value="<?php echo $user->data->user_nicename ?>" id="author" name="author">
        <input class="form-control" type="hidden" aria-required="true" tabindex="2" value="<?php echo $user->data->user_email ?>" id="email" name="email">
            <?php } ?>
    <div class="form-group">
        <label class="col-sm-2 ">Nội dung</label>
        <div class="col-sm-10">
<?php wp_editor('', 'comment', array('media_buttons' => false)); ?>
            <style>
                #comment_ifr{height: 110px!important;}
                textarea#comment{height: 110px!important;}
            </style>
<!--            <textarea class="form-control" tabindex="4" id="comment" name="comment"></textarea>-->
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-success" value="Gửi đánh giá" tabindex="5" id="submit" name="submit">
        </div>
    </div>

    <div>
        <input type="hidden" id="comment_post_ID" value="<?php echo get_the_ID() ?>" name="comment_post_ID">
        <input type="hidden" value="0" id="comment_parent" name="comment_parent">
    </div>


</form>

