<?php

/**
 * Remove Astra extra spacing
 */
add_filter('astra_stretched_layout_with_spacing', '__return_false');


/**
 * Enqueue styles
 */
function child_enqueue_styles() {
   $version = CHILD_THEME_ASTRA_CHILD_JONAS_VERSION;
   wp_enqueue_style('astra-child-jonas-grid-css', get_stylesheet_directory_uri() . '/styles/bundle.css', ['astra-theme-css'], $version, 'all');
}
add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);
