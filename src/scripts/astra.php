<?php

/**
 * Remove Astra extra spacing
 */
add_filter('astra_stretched_layout_with_spacing', '__return_false');


/**
 * Enqueue styles
 */
add_action('wp_enqueue_scripts', function() {
   $version = CHILD_THEME_WP_BETTER_ASTRA_CHILD_VERSION;
   wp_enqueue_style('wp-better-astra-child-grid-css', get_stylesheet_directory_uri() . '/styles/bundle.css', ['astra-theme-css'], $version, 'all');
}, 15);
