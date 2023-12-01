<?php

function custom_admin_styles() {
   wp_enqueue_style('custom-admin-styles', get_stylesheet_directory_uri() . '/admin/wp-admin.css');
}
add_action('admin_enqueue_scripts', 'custom_admin_styles');
