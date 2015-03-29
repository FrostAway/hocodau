<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
	</title>
	
	<link rel="shortcut icon" href="/favicon.ico">
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        
        <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/assets/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/assets/css/editor_bar.css" />
        <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/assets/css/style.css" />


        <script src="<?php bloginfo('template_directory') ?>/assets/js/jquery.min.js"></script>
        <script src="<?php bloginfo('template_directory') ?>/assets/js/jquery-ui.min.js"></script>
        
        <script src="<?php bloginfo('template_directory') ?>/assets/js/slide.js"></script>
        <script src="<?php bloginfo('template_directory') ?>/assets/js/custom.js"></script>

	<?php if ( is_singular() ) wp_enqueue_script('comment-reply'); ?>
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
	<!-- facebook like -->
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&appId=1395390994084918&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!--<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&appId=1418616455105788&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>-->
	<?php
        if(!current_user_can( 'manage_options' ) && !is_page(256)){
            echo '<script>window.location.href="'.  get_page_link(256).'"</script>';
        }
        ?>

<div id="top-header">
    <div class="container">
        <div class="nav pull-right" id="top-links">
            <ul class="list-inline">
                <li class="dropdown">
                    <?php if(!is_user_logged_in()){ ?>
                    
                    <a href="" class="btn btn-default btn-sm" data-toggle="modal" data-target="#loginform"><span class="fa fa-sign-in"> </span> <span class="hidden-xs">Đăng Nhập</span></a>
                    <a href="<?= get_page_link(107) ?>" class="btn btn-default btn-sm"><span class="fa  fa-user-md"> </span> <span class="hidden-xs">Đăng Ký</span></a>
                    <?php }else{ ?>
                    <a class="btn btn-default btn-sm" data-toggle="dropdown" class="dropdown-toggle" title="Tài khoản" href=""><i class="fa fa-user"> </i> <span class="hidden-xs"> <?= wp_get_current_user()->user_login ?> </span> <span class="caret"></span></a>
                    <a class="btn btn-default btn-sm" href="<?= get_edit_user_link() ?>"><span class="fa fa-dashboard"> </span> <span class="hidden-xs">Trang quản lý</span></a>
                    <a class="btn btn-default btn-sm" href="<?= wp_logout_url(home_url()) ?>"><span class="fa fa-sign-out"> </span> <span class="hidden-xs">Đăng xuất</span></a>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</div>

	<div id="header">
            <div class="container">
                <div class="row">
                    <div id="logo" class="col-xs-12 col-sm-5 col-md-5 col-lg-4">
                        <a href="<?php echo home_url() ?>"><img src="<?= get_option('home-logo') ?>"  /></a>
                    </div>
                    <div id="right-header" class="col-xs-12 col-sm-7 col-md-7 col-lg-8">
                        <div class="row">
                            <div class="col-sm-12 col-lg-10" style="text-align: right;">
                                <h3>THAM KHẢO CHUYÊN GIA TƯ VẤN</h3>
                                <div class="hot-line"><i class="fa fa-phone"> </i> <?= get_option('home-hotline') ?></div>
                            </div>
                            <div class="col-sm-12 col-lg-2">
                                <ul class="list-inline top-icon">
                                    <li><a href="#"><img src="<?php bloginfo('template_directory') ?>/assets/images/header/icon-08.png" /></a></li>
                                    <li><a href="#"><img src="<?php bloginfo('template_directory') ?>/assets/images/header/icon-09.png" /></a></li>
                                    <li><a href="#"><img src="<?php bloginfo('template_directory') ?>/assets/images/header/icon-10.png" /></a></li>
                                    <li><a href="#"><img src="<?php bloginfo('template_directory') ?>/assets/images/header/icon-11.png" /></a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 col-sm-offset-4 col-lg-offset-3 col-md-offset-4">
                        <div class="search-form">
                            <?php get_search_form(); ?>
                        </div>
                        <script>
                            jQuery('#basic-addon2').click(function(){
                                jQuery('#search-form').submit();
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <!-- End header -->
        <?php if(!is_home()){ ?>
        <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php include_once 'includes/small-menu.php'; ?>
            </div>
        </div>
        </div>
        <?php } ?>
        
       