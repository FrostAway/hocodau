<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 column-left">
    <div class="bar-course hidden-xs">
        <a href="<?php echo home_url() ?>/course-cat/tat-ca-khoa-hoc"><h3 class="">Các Khóa học</h3></a>
            <?php
            wp_reset_query();            wp_reset_postdata();
            
                wp_nav_menu(array('theme_location'=>'course-menu-2', 'container'=>'', 'menu_class'=>'list-unstyled')); 
            
            ?>
    </div>

    <div class="bar-review hidden-xs">
        <h3>Review</h3>
        <ul class="list-unstyled">
            <li><a href="<?php echo home_url() ?>/?page_id=64">Trung tâm Tiếng Anh</a></li>
            <li><a href="<?php echo home_url() ?>/?page_id=68">Giáo viên Tiếng Anh</a></li>
            <li><a href="<?php echo home_url() ?>/?page_id=66">Câu lạc bộ Tiếng Anh</a></li>
            <li><a href="<?php echo home_url() ?>/?cat=17">Phương pháp học Tiếng Anh</a></li>         
        </ul>
    </div>
    
    <div class="bar-review hidden-xs" style="display: none;">
        <h3>Gia sư Tiếng Anh</h3>
        <?php wp_nav_menu(array('theme_location'=>'tutor-menu', 'container'=>'', 'menu_class'=>'list-unstyled')); ?>
    </div>

    <div class="bar-event hidden-xs">
        <h3>Sự kiện</h3>
        <?php wp_nav_menu(array('theme_location'=>'event-menu', 'container'=>'', 'menu_class'=>'list-unstyled')); ?>
    </div>
	
	<div class="bar-share bar-event hidden-xs">
		<h3>Chia sẻ</h3>
		<?php wp_nav_menu(array('theme_location'=>'share-menu', 'container'=>'', 'menu_class'=>'list-unstyled')); ?>
	</div>

   <div class="bar-boxs">
        <div class="facbook-like-box" style="width: 100%;">
            <div class="fb-page" 
                 style="
                 transform: scale(0.94); 
                 -moz-transform: scale(0.94);
                 margin-left: -9px;
                 " 
                 data-href="https://www.facebook.com/hoctienganhodauvn"  data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
                <div class="fb-xfbml-parse-ignore">
                    <blockquote cite="https://www.facebook.com/hoctienganhodauvn">
                        <a href="https://www.facebook.com/hoctienganhodauvn">Hocodau.vn - Học tiếng Anh như thế nào, ở đâu ?</a>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end left column -->
