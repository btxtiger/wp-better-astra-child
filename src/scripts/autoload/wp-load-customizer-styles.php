<?php

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
