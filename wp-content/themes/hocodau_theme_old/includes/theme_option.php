<?php
// theme option
add_action('admin_menu', function() {
    add_theme_page('My Theme Option', 'Hiển thị trang chủ', 'manage_options', 'my-them-option', 'home_page_setting');
    // ten hien thi         hien thi menu     nguoi co quyen    id ten                ham setting
});

add_action('admin_init', function() {
    register_setting('home-page-group', 'home-logo');
    register_setting('home-page-group', 'home-hotline');
    
    register_setting('home-page-group', 'slide-img1');
    register_setting('home-page-group', 'slide-img2');
    register_setting('home-page-group', 'slide-img3');
    register_setting('home-page-group', 'slide-img4');
    register_setting('home-page-group', 'slide-img5');
    
    register_setting('home-page-group', 'link-to1');
    register_setting('home-page-group', 'link-to2');
    register_setting('home-page-group', 'link-to3');
    register_setting('home-page-group', 'link-to4');
    register_setting('home-page-group', 'link-to5');
});

function home_page_setting() {
    ?>
    <div class="wrap">
        <?php screen_icon(); ?>
        <h2>Display Option</h2>
        <form id="home_page_setting" method="post" action="options.php">
            <?php settings_fields('home-page-group'); ?>
            <h3>Logo: </h3>
            <div style="margin:10px;" >
                <label style="float:left; margin: 5px 5px 0 0;">Ảnh Logo:</label>
                <input type="text" id="home-logo" name="home-logo" value="<?php echo get_option('home-logo') ?>" style="width: 450px; float:left; margin:0 5px;"/>
                <input class="button" id="btn-logo" class="upload_image_button" type="button" value="Upload" />
            </div>
            <hr/>
            
            <h3 style="clear: both;">Hotline: </h3>
            <div style="margin:10px;" >
                <label style="float:left; margin: 5px 5px 0 0;">Hotline:</label>
                <input type="text" id="home-hotline" name="home-hotline" value="<?php echo get_option('home-hotline') ?>" style="width: 450px; float:left; margin:0 5px 10px;"/>
            </div>
            <hr style="clear: both;" />
            <h3 style="clear: both;">Chọn ảnh hiển thị Slide</h3>
            <?php for ($i=1; $i<=5; $i++){ ?>
            <div style="margin:10px; float: left;" >
                <label style="float:left; margin: 5px 5px 0 0;">Ảnh <?php echo $i ?>:</label>
                <input type="text" id="image_<?= $i ?>" name="slide-img<?php echo $i ?>" value="<?php echo get_option('slide-img'.$i) ?>" style="width: 350px; float:left; margin:0 5px;"/>
                <input class="button" id="_btn" onclick="upload_image(<?= $i ?>)" class="upload_image_button" type="button" value="Upload" />
            </div>
            <div style="margin:10px; float: left;">
                <label>Link đến: </label>
                <input type="text" name="link-to<?php echo $i ?>" value="<?php echo get_option('link-to'.$i) ?>" style="width: 300px;" />
            </div>
            <div style="clear: both"></div>
            <?php } ?>


            <?php add_thickbox(); wp_enqueue_media(); ?>
            <script>
                
                function upload_image(id) {
                 var custom_uploader;
                 if (custom_uploader) {
                    custom_uploader.open();
                    return;
                }
                //Extend the wp.media object
                custom_uploader = wp.media.frames.file_frame = wp.media({
                    title: 'Choose Image',
                    button: {
                        text: 'Choose Image'
                    },
                    multiple: false
                });

                //When a file is selected, grab the URL and set it as the text field's value
                custom_uploader.on('select', function () {
                    attachment = custom_uploader.state().get('selection').first().toJSON();
                    jQuery("#image_" + id).val(attachment.url);
                    custom_uploader.close();
                });
                //Open the uploader dialog
                custom_uploader.open();
                 
                 return false;
                }
                
                jQuery('#btn-logo').click(function(){
                    var custom_uploader;
                 if (custom_uploader) {
                    custom_uploader.open();
                    return;
                }
                //Extend the wp.media object
                custom_uploader = wp.media.frames.file_frame = wp.media({
                    title: 'Choose Image',
                    button: {
                        text: 'Choose Image'
                    },
                    multiple: false
                });

                //When a file is selected, grab the URL and set it as the text field's value
                custom_uploader.on('select', function () {
                    attachment = custom_uploader.state().get('selection').first().toJSON();
                    jQuery("#home-logo").val(attachment.url);
                    custom_uploader.close();
                });
                //Open the uploader dialog
                custom_uploader.open();
                 
                 return false;
                });
            </script>

            <?php submit_button(); ?>
        </form>
    </div>
        <?php
    }
