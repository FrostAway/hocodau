<?php
add_filter('manage_course_posts_columns', 'myown_add_post_columns');

function myown_add_post_columns($columns) {
    $columns['course-featured'] = 'Featured';
    return $columns;
}

add_action('manage_course_posts_custom_column', 'myown_render_post_columns', 10, 2);

function myown_render_post_columns($column_name, $id) {
    switch ($column_name) {
        case 'course-featured':
            // show my_field
            $my_fieldvalue = get_post_meta($id, 'course-featured', TRUE);
            $check = '';
            if ($my_fieldvalue == 'on') {
                $check = 'checked';
            }
            echo '<input class="quick-edit-featured" type="checkbox" ' . $check . ' />';
            ?>
            <script>
            jQuery(".quick-edit-featured").prop('disabled', true);
            </script>
            <?php
    }
}

add_action('quick_edit_custom_box', 'myown_add_quick_edit', 10, 2);

function myown_add_quick_edit($column_name, $post_type) {
    if ($column_name != 'course-featured')
        return;
    ?>
    <fieldset class="inline-edit-col-left">
        <div class="inline-edit-col">
            <span class="title">Featured</span>
            <input id="course-featured_noncename" type="hidden" name="course-featured_noncename" value="" />
            <input id="quick-edit-course-featured" type="checkbox" name="course-featured" value=""/>
        </div>
    </fieldset>
    <?php
}

// Add to our admin_init function
add_action('save_post', 'myown_save_quick_edit_data');

function myown_save_quick_edit_data($post_id) {
    // verify if this is an auto save routine.        
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    // Check permissions    
    if ('course' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } else {
        if (!current_user_can('edit_post', $post_id))
            return $post_id;
    }
    // Authentication passed now we save the data      
    if (isset($_POST['course-featured']) && ($post->post_type != 'revision')) {
        $my_fieldvalue = esc_attr($_POST['course-featured']);
        if ($my_fieldvalue)
            update_post_meta($post_id, 'course-featured', $my_fieldvalue);
        else
            delete_post_meta($post_id, 'course-featured');
    }
    return $my_fieldvalue;
}

add_action('admin_footer', 'myown_quick_edit_javascript');

function myown_quick_edit_javascript() {
    global $current_screen;
    if (($current_screen->post_type != 'course'))
        return;
    ?>
    <script type="text/javascript">
        function set_myfield_value(fieldValue, nonce) {
            // refresh the quick menu properly
            inlineEditPost.revert();
            console.log(fieldValue);
            if (fieldValue === 'on') {
                jQuery("#quick-edit-course-featured").prop('checked', true);
            }
        }
    </script>
    <?php
}

// Add to our admin_init function
add_filter('post_row_actions', 'myown_expand_quick_edit_link', 10, 2);

function myown_expand_quick_edit_link($actions, $post) {
    global $current_screen;
    if (($current_screen->post_type != 'course'))
        return $actions;
    $nonce = wp_create_nonce('course-featured_' . $post->ID);
    $myfielvalue = get_post_meta($post->ID, 'course-featured', TRUE);
    $actions['inline hide-if-no-js'] = '<a href="#" class="editinline" title="';
    $actions['inline hide-if-no-js'] .= esc_attr(__('Edit this item inline')) . '"';
    $actions['inline hide-if-no-js'] .= " onclick=\"set_myfield_value('{$myfielvalue}', '{$nonce}')\" >";
    $actions['inline hide-if-no-js'] .= __('Quick Edit');
    $actions['inline hide-if-no-js'] .= '</a>';
    return $actions;
}
