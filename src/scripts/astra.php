<?php

/**
 * Remove Astra extra spacing
 */
add_filter('astra_stretched_layout_with_spacing', '__return_false');
add_filter('run_wptexturize', '__return_false');

/**
 * Enqueue styles
 */
add_action('wp_enqueue_scripts', function() {
   $version = CHILD_THEME_WP_BETTER_ASTRA_CHILD_VERSION;
   wp_enqueue_style('wp-better-astra-child-colors-css', get_stylesheet_directory_uri() . '/colors/index.css', ['astra-theme-css'], $version, 'all');
   wp_enqueue_style('wp-better-astra-child-grid-css', get_stylesheet_directory_uri() . '/styles/index.css', ['astra-theme-css'], $version, 'all');
}, 15);

// Enqueue styles in admin area
add_action('admin_enqueue_scripts', function() {
   $version = CHILD_THEME_WP_BETTER_ASTRA_CHILD_VERSION;
   wp_enqueue_style('wp-better-astra-child-admin-css', get_stylesheet_directory_uri() . '/colors/index.css', [], $version, 'all');
});
