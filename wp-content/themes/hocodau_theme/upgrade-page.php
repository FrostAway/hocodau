<?php
/*
 * Template Name: upgrade page
 */
?>

<?php get_header(); ?>

<div id="main">
    <div class="main-bg"></div>
    <div class="container">
        <div class="row">
            <h2 style="color: #00cc00;">HOCODAU.VN -trang thông tin cho người học tiếng anh việt nam - COMING SOON.....</h2>

            <div class="upgrade">
                <div class="animate">
                    <div class="mess">I'm Coming ..... </div>
                    <img class="running" src="<?= get_template_directory_uri() ?>/assets/images/body/animation-5.png" />
                </div>
            </div>    

            <script>
                $(document).ready(function () {
                    function car_run() {
                        if ($('.running').css('margin-left') === '-540px') {
                            $('.running').animate({'margin-left': '0px'}, 0, function () {
                            });
                        } else {
                            $('.running').animate({'margin-left': '-540px'}, 0, function () {
                            });
                        }
                    }
                    var bon = setInterval(car_run, 200);
                });
            </script>
        </div>
    </div>
</div>
<!-- end main -->

<?php get_footer(); ?>