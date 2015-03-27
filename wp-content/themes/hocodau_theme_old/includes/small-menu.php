<div id="small-menu" class="hidden-sm hidden-md hidden-lg">
    <nav class="navbar navbar-default my-nav">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Học Ở Đâu</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Các Khóa Học <span class="caret"></span></a>
                            <?php wp_nav_menu(array('theme_location' => 'course-menu', 'container' => '', 'menu_class' => 'dropdown-menu')); ?>
                        </li>
                    </ul>
                

                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Review <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo home_url() ?>/?page_id=64">Trung tâm Tiếng Anh</a></li>
                            <li><a href="<?php echo home_url() ?>/?page_id=68">Giáo viên Tiếng Anh</a></li>
                            <li><a href="<?php echo home_url() ?>/?page_id=66">Câu lạc bộ Tiếng Anh</a></li>
                            <li><a href="<?php echo home_url() ?>/?cat=17">Phương pháp học Tiếng Anh</a></li>         
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Gia sử Tiếng Anh <span class="caret"></span></a>
                        <?php wp_nav_menu(array('theme_location' => 'tutor-menu', 'container' => '', 'menu_class' => 'dropdown-menu')); ?>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Sự kiện <span class="caret"></span></a>
                            <?php wp_nav_menu(array('theme_location' => 'event-menu', 'container' => '', 'menu_class' => 'dropdown-menu')); ?>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>

