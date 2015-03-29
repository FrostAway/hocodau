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

    <div class="bar-boxs">
        <?php $page1 = get_page(41);  ?>
        <div class="panel panel-default">
            <img class="icon" src="<?php bloginfo('template_directory') ?>/assets/images/body/bar-icon-1.png" />
            <h3><a href="<?= get_page_link($page1->ID) ?>"><?php echo $page1->post_title ?></a></h3>
            <div class="clearfix"></div>
            <p>
                <?= wp_trim_words($page1->post_content, 30); ?>
            </p>
        </div>
        
        <?php $page2 = get_page(44); ?>
        <div class="panel panel-default">
            <img class="icon" src="<?php bloginfo('template_directory') ?>/assets/images/body/bar-icon-2.png" />
            <h3><a href="<?= get_page_link($page2->ID) ?>"><?php echo $page2->post_title ?></a></h3>
            <div class="clearfix"></div>
            <p>
                <?= wp_trim_words($page2->post_content, 30) ?>
            </p>
        </div>
        
        <?php $page3 = get_page(46); ?>
        <div class="panel panel-default">
            <img class="icon" src="<?php bloginfo('template_directory') ?>/assets/images/body/bar-icon-3.png" />
            <h3><a href="<?= get_page_link($page3->ID) ?>"><?php echo $page3->post_title ?></a></h3>
            <div class="clearfix"></div>
            <p>
                <?= wp_trim_words($page3->post_content, 30) ?>
            </p>
        </div>
    </div>
</div>
<!-- end left column -->
