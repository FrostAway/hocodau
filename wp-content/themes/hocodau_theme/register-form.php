<?php
/*
 * Template Name: Register Form
 */
?>
<?php get_header(); ?>

<div id="main">
    <script>
        // This is called with the results from from FB.getLoginStatus().
        function statusChangeCallback(response) {
            console.log('statusChangeCallback');
            console.log(response);
            if (response.status === 'connected') {
                // Logged into your app and Facebook.
                testAPI();
            } else if (response.status === 'not_authorized') {
                // The person is logged into Facebook, but not your app.
                document.getElementById('status').innerHTML = 'Please log ' +
                        'into this app.';
            } else {
                // The person is not logged into Facebook, so we're not sure if
                // they are logged into this app or not.
                document.getElementById('status').innerHTML = 'Please log ' +
                        'into Facebook.';
            }
        }

        function checkLoginState() {
            FB.getLoginStatus(function (response) {
                statusChangeCallback(response);
            });
        }

        window.fbAsyncInit = function () {
            FB.init({
                appId: '811075892313692',
                cookie: true, // enable cookies to allow the server to access 
                // the session
                xfbml: true, // parse social plugins on this page
                version: 'v2.2' // use version 2.2
            });

            FB.getLoginStatus(function (response) {
                statusChangeCallback(response);
            });

        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function testAPI() {
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me', function (response) {
                console.log('Successful login for: ' + response.name);
                document.getElementById('username').value = response.name;
                document.getElementById('email').value = response.email;
                document.getElementById('avatar_url').value = 'https://graph.facebook.com/response.id/picture?width=140&height=110';
            });
        }
        
        
    </script>
    <div class="main-bg"></div>
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 column-right">                       


                <div class="main-box">
                    <div class="box-title">
                        <h3><strong>Đăng ký</strong></h3>
                    </div>
                    <?php if (!is_user_logged_in()) { ?>

                        <?php if (isset($_GET['status'])) {
                            if ($_GET['status'] == 'error') {
                                ?>
                                <div class="status" style="color: #ff6633; margin-top: 15px;">Có lỗi xảy ra!</div>
                            <?php }
                            if ($_GET['status'] == 'exist') {
                                ?>
                                <div class="status" style="color: #ff0033; margin-top: 15px;">Tên đăng nhập hoặc email đã tồn tại! </div>
        <?php }
    }
    ?>

                        <div class="register-form" style="margin-top: 30px;">
                            <form class="form-horizontal" method="post" action="">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Chọn vai trò: </label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="default_role" name="default_role">
                                            <option value="author" selected="selected">Tác giả/Thành viên</option>
                                            <option value="english-center-role">Trung tâm Tiếng Anh</option>
                                            <option value="english-teacher-role">Giáo viên Tiếng Anh</option>
                                            <option value="english-club-role">Câu lạc bộ Tiếng Anh</option>
                                            <option value="english-tutor-role">Gia sư Tiếng Anh</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Tên đăng nhập</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="username" name="username" class="form-control"  placeholder="Tên đăng nhập" required="">
                                    </div>
                                </div>

                                <div id="user_option_role">

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" id="email" name="email" class="form-control"  placeholder="example@mail.com" required="" >
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
<!--                                        <textarea name="bio" class="form-control" rows="4" placeholder="Giới thiệu"></textarea>-->
                                        <?php wp_editor('', 'bio', array('textarea_rows'=>7)) ?>
                                    </div>
                                </div>
                                <input type="hidden" id="avatar_url" name="avatar" />

                                <?php
                                global $wp;
                                $current_url = home_url(add_query_arg(array(), $wp->request))
                                ?>
                                <input type="hidden" name="current_url" value="<?= $current_url ?>" />

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">

                                        <button type="submit" name="register-submit" class="btn btn-default">Đăng ký</button>
                                        <fb:login-button class="" scope="public_profile,email" onlogin="checkLoginState();"> Đăng ký với Facebook
                                        </fb:login-button>
                                    </div>
                                </div>
                            </form>
                        </div>
            <?php
            } else {
                echo 'Bạn đang đăng nhập, không thể đăng ký. <a href="' . wp_logout_url(get_page_link(107)) . '">Đăng xuất</a>';
            }
            ?>
                </div>
                <!-- end main box -->
            </div>

<?php get_sidebar('left') ?>

        </div>
    </div>
</div>
<!-- end main -->


<?php get_footer(); ?>
