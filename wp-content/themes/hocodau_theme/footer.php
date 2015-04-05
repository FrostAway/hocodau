
<div class="bg-gr"></div>

<div class="modal fade" id="loginform" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Đăng nhập</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo wp_login_url(); ?>" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3">Tên tài khoản</label>
                        <div class="col-sm-9">
                            <input id="user_login" name="log" class="form-control" type="text" value="" class="username" placeholder="Tên tài khoản" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3">Mật khẩu</label>
                        <div class="col-sm-9">
                            <input id="user_pass" name="pwd" class="form-control" type="password" class="password" placeholder="Mật khẩu" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember" value="forever" id="rememberme"/> Nhớ đăng nhập</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            Chưa có tài khoản - <a href="<?php echo get_page_link(107) ?>">Đăng ký</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-10">
                            <div class="status"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-10">
                            <div id="login_status">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-success" id="btn-login-form">Đăng nhập</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                <?php
                global $wp;
                $current_url = home_url(add_query_arg(array(), $wp->request))
                ?>
                <script>
                    jQuery(document).ready(function () {
                        jQuery('#btn-login-form').click(function () {
                            var curr_url = '<?php echo $current_url; ?>';
                            var home = '<?php echo $current_url; ?>';
                            jQuery.ajax({
                                type: 'POST',
                                dataType: 'json',
                                url: '<?= admin_url('admin-ajax.php') ?>',
                                data: {
                                    action: 'login_ajax_action',
                                    username: jQuery('#user_login').val(),
                                    password: jQuery('#user_pass').val()
                                },
                                success: function (data) {
                                    if (data.stt === 1) {
                                        jQuery('#login_status').html(data.mess);
                                    } else {
                                        jQuery('#login_status').html(data.mess);
                                        setTimeout(function () {
                                            window.location.href = home;
                                        }, 1000);
                                    }
                                }
                            });
                            return false;
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <h4>Thông tin</h4>
                <ul class="list-unstyled">
                    <li><a href="#">Trang chủ</a></li>
                    <li><a href="#">Tìm kiếm</a></li>
                    <li><a href="#">Tin tức</a></li>
                    <li><a href="#">Liên hệ</a></li>
                </ul>
            </div>
            <div class="col-sm-2">
                <h4>Khảo sát</h4>
                <ul class="list-unstyled">
                    <li><a href="#">Trang chủ</a></li>
                    <li><a href="#">Tìm kiếm</a></li>
                    <li><a href="#">Tin tức</a></li>
                    <li><a href="#">Liên hệ</a></li>
                </ul>
            </div>
            <div class="col-sm-2">
                <h4>Khóa học</h4>
                <ul class="list-unstyled">
                    <li><a href="#">Trang chủ</a></li>
                    <li><a href="#">Tìm kiếm</a></li>
                    <li><a href="#">Tin tức</a></li>
                    <li><a href="#">Liên hệ</a></li>
                </ul>
            </div>
            <div class="col-sm-4 col-sm-offset-2">
                <ul class="list-inline">
                    <li><a href="#"><img src="<?php bloginfo('template_directory') ?>/assets/images/footer/icon-truoc-14.png" /></a></li>
                    <li><a href="#"><img src="<?php bloginfo('template_directory') ?>/assets/images/footer/icon-truoc-15.png" /></a></li>
                    <li><a href="#"><img src="<?php bloginfo('template_directory') ?>/assets/images/footer/icon-truoc-16.png" /></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="copy-right">
        <div class="container">
            Công ty CPTNHH ABS. All rights reserved. 2015
        </div>
    </div>
</div>


<script src="<?php bloginfo('template_directory') ?>/assets/dist/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_directory') ?>/assets/js/rating.js"></script>

<?php wp_footer(); ?>
</body>
</html>

