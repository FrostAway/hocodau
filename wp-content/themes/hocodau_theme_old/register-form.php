<?php
/*
 * Template Name: Register Form
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
                        <h3><strong>Đăng ký</strong></h3>
                    </div>
                    <?php if(!is_user_logged_in()){ ?>
                    <div class="register-form" style="margin-top: 30px;">
                        <form class="form-horizontal" method="post" action="">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Chọn vai trò: </label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="default_role" name="default_role">
                                        <option value="author" selected="selected">Tác giả/Thành viên</option>
                                        <option value="english-tutor">Gia sư Tiếng Anh</option>
                                        <option value="english-teacher">Giáo viên Tiếng Anh</option>
                                        <option value="english-club">Câu lạc bộ Tiếng Anh</option>
                                        <option value="english-center">English Center</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tên đăng nhập</label>
                                <div class="col-sm-10">
                                    <input type="text" name="username" class="form-control"  placeholder="Tên đăng nhập" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control"  placeholder="example@mail.com" required="" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Giới thiệu</label>
                                <div class="col-sm-10">
                                    <textarea name="bio" class="form-control" placeholder="Giới thiệu"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="register-submit" class="btn btn-default">Đăng ký</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php }else{
                        echo 'Bạn đang đăng nhập, không thể đăng ký. <a href="'.wp_logout_url(get_page_link(107)).'">Đăng xuất</a>';
                    } ?>
                </div>
                <!-- end main box -->
            </div>
            
            <?php get_sidebar('left') ?>

        </div>
    </div>
</div>
<!-- end main -->


<?php get_footer(); ?>
