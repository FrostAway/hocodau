<?php
// theme option
add_action('admin_menu', function() {
    add_theme_page('My Theme Option', 'Hiển thị trang chủ', 'manage_options', 'my-them-option', 'home_page_setting');
    // ten hien thi         hien thi menu     nguoi co quyen    id ten                ham setting
});

add_action('admin_init', function() {
    register_setting('home-page-group', 'home-logo');
    register_setting('home-page-group', 'home-hotline');
    
    register_setting('home-page-group', 'banner-img');
    register_setting('home-page-group', 'banner-title-1');
    register_setting('home-page-group', 'banner-title-2');
    
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
            <h3 style="clear: both;">Chọn ảnh hiển thị Banner</h3>
            <div style="margin:10px; float: left;" >
                <label style="float:left; margin: 5px 5px 0 0;">Ảnh :</label>
                <input type="text" id="banner-img" name="banner-img" value="<?php echo get_option('banner-img') ?>" style="width: 350px; float:left; margin:0 5px;"/>
                <input class="button" id="banner-img-btn" onclick="" class="upload_image_button" type="button" value="Upload" />
            </div>
            
            <hr />
            <h3 style="clear: both;">Banner-title</h3>
            <div style="margin: 10px;">
                 <label style="float:left; margin: 5px 5px 0 0;">Title 1:</label>
                <input type="text" name="banner-title-1" value="<?php echo get_option('banner-title-1') ?>" style="width: 350px; float:left; margin:0 5px;"/>
            </div>
            <div style="margin: 10px;">
                 <label style="float:left; margin: 5px 5px 0 0;">Title 2:</label>
                <input type="text" name="banner-title-2" value="<?php echo get_option('banner-title-2') ?>" style="width: 350px; float:left; margin:0 5px;"/>
            </div>
            <div style="clear: both"></div>

            <?php add_thickbox(); wp_enqueue_media(); ?>
            <script>
                
               jQuery('#banner-img-btn').click(function(){
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
                    jQuery("#banner-img").val(attachment.url);
                    custom_uploader.close();
                });
                //Open the uploader dialog
                custom_uploader.open();
                 
                 return false;
                });
                
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
