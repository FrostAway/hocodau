<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		This post is password protected. Enter the password to view comments.
	<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>
	
	<h2 id="comments"><?php comments_number('Không có bình luận nào', 'Có một bình luận', '% Bình luận' );?></h2>
        
        <div id="comment-rank">
            <strong>Hiển thị: </strong>
            <a href="#" post-id="<?= get_the_ID(); ?>" id="comment-newest">Mới nhất</a> || 
            <a href="#" post-id="<?= get_the_ID(); ?>" id="comment-most-like">Like nhiều nhất</a>
        </div>
        
	<div class="navigation">
		<div class="next-posts"><?php prev?></div>
                <div class="prev-posts"><?php next_comments_link() ?></div>
	</div>
        
	<ol class="commentlist">
		<?php wp_list_comments(array(
                    'reverse_top_level' => true,
                    'avatar_size' => 87,
                    'callback' => 'comment_with_like'
                ), get_comments(array(
                    'post_id' => get_the_ID()
                ))); ?>
	</ol>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>
	
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<p>Comments are closed.</p>

	<?php endif; ?>
	
<?php endif; ?>

<?php if ( comments_open() ) : ?>

<div id="respond">

	<h2><?php comment_form_title( 'Tham gia bình luận', 'Bình luận cho %s' ); ?></h2>

	<div class="cancel-comment-reply">
		<?php cancel_comment_reply_link(); ?>
	</div>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
	<?php else : ?>

                <form class="form-horizontal" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

		<?php if ( is_user_logged_in() ) : ?>

			<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

		<?php else : ?>
                        
                        
                        <div class="form-group">
                            <label class="col-sm-2" for="author">Họ Tên: <?php if ($req) echo "(*)"; ?></label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
                            </div>
			</div>

                        <div class="form-group">
                            <label class="col-sm-2" for="email">Mail (Sẽ không publish) <?php if ($req) echo "(*)"; ?></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
                            </div>
				
			</div>

                        <div class="form-group">
                            <label class="col-sm-2" for="url">Website</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
                            </div>
			</div>

		<?php endif; ?>

		<!--<p>You can use these tags: <code><?php echo allowed_tags(); ?></code></p>-->

		<div>
                    <textarea class="form-control" name="comment" id="comment" cols="58" rows="5" tabindex="4"></textarea>
                    
<!--                    <div id="editor_bar">
                        <a href="#" class="ibold fa fa-bold" onclick="iBold()"></a>
                        <a href="#" class="iunderline fa fa-underline" onclick="iUnderline()"></a>
                        <a href="#" class="iitalic fa fa-italic" onclick="iItalic()"></a>
                        <select class="ifontsize" onchange="iFontSize()">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                        </select>
                        <a href="#" class="ilink fa fa-link" onclick="iLink()"></a>
                        <a href="#" class="iunlink fa fa-unlink" onclick="iUnLink()"></a>
                        <a href="#" class="iimage fa fa-image"  onclick="iImage()"  ></a>
                        <a href="#" class="iol fa fa-list-ol"  onclick="iOrderedList()"></a>
                        <a href="#" class="iunol fa fa-list-ul"  onclick="iUnOrderedList()" ></a>
                        <a href="#" class="center fa fa-align-center"  onclick="iCenter()" ></a>
                        <a href="#" class="justifyfull fa fa-align-justify"  onclick="iJustify()" ></a>
                        <a href="#" class="justifyleft fa fa-align-left"  onclick="iLeft()" ></a>
                        <a href="#" class="justifyright fa fa-align-right"  onclick="iRight()" ></a>
                    </div>
                    <iframe contenteditable="true"  name="ifr_content" id="ifr_content"></iframe>-->
		</div>

		<div>
                    <input style="margin-top: 15px;" class="btn btn-success" name="submit" type="submit" id="submit" tabindex="5" value="Gửi bình luận" />
			<?php comment_id_fields(); ?>
		</div>
		
		<?php do_action('comment_form', $post->ID); ?>

	</form>
                
	<?php endif; // If registration required and not logged in ?>
	
</div>

<?php endif; ?>
