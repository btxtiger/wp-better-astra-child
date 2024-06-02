<?php

/**
 * Enqueue styles in admin area
 */
function custom_admin_styles() {
   wp_enqueue_style('custom-admin-styles', get_stylesheet_directory_uri() . '/admin/wp-admin.css');
}
add_action('admin_enqueue_scripts', 'custom_admin_styles');

/**
 * Enqueue scripts for customizer
 */
function my_theme_customizer_script() {
   wp_enqueue_style(
      'custom-customizer-hacks',
      get_stylesheet_directory_uri() . '/admin/customizer.css',
      [], // dependencies, if any, like 'jquery'
      '1.0.2',
      'all',
   );
}
add_action('customize_controls_enqueue_scripts', 'my_theme_customizer_script');

// Set the default post order in admin area
function set_post_order_in_admin( $wp_query ) {
   global $pagenow;

   if ( is_admin() && 'edit.php' == $pagenow && !isset($_GET['orderby'])) {
      $wp_query->set( 'orderby', 'modified' ); // Changed from 'title' to 'modified'
      $wp_query->set( 'order', 'DESC' ); // Posts will be shown from most recently modified to least
   }
}
add_filter('pre_get_posts', 'set_post_order_in_admin', 5 );
