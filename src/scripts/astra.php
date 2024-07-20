<?php

/**
 * Remove Astra extra spacing
 */
add_filter('astra_stretched_layout_with_spacing', '__return_false');

/**
 * Enqueue styles
 */
add_action('wp_enqueue_scripts', function () {
   $version = CHILD_THEME_WP_BETTER_ASTRA_CHILD_VERSION;

   wp_enqueue_style('wp-better-astra-child-colors-compatibility-v1', get_stylesheet_directory_uri() . '/colors/compatibility-v1.css', ['astra-theme-css'], $version, 'all');

   // Load custom MD theme from css files in the wp-content/uploads/astc-colors directory
   $upload_dir = WP_CONTENT_DIR . '/uploads/astc-colors';
   if (is_dir($upload_dir)) {
      if ($files = glob("$upload_dir/*.css")) {
         foreach ($files as $file) {
            $fileUrl = content_url(str_replace(WP_CONTENT_DIR, '', $file));
            wp_enqueue_style("wp-better-astra-child-custom-" . pathinfo($file, PATHINFO_FILENAME), $fileUrl, ['astra-theme-css'], $version, 'all');
         }
      } else {
         wp_enqueue_style('wp-better-astra-child-colors-A', get_stylesheet_directory_uri() . '/colors/index_A.css', ['astra-theme-css'], $version, 'all');
      }
   }

   wp_enqueue_style('wp-better-astra-child-colors-B', get_stylesheet_directory_uri() . '/colors/index_B.css', ['astra-theme-css'], $version, 'all');

   wp_enqueue_style('wp-better-astra-child-grid', get_stylesheet_directory_uri() . '/styles/index.css', ['astra-theme-css'], $version, 'all');
}, 15);


// Enqueue styles in admin area
add_action('admin_enqueue_scripts', function () {
   $version = CHILD_THEME_WP_BETTER_ASTRA_CHILD_VERSION;
   wp_enqueue_style('wp-better-astra-child-admin', get_stylesheet_directory_uri() . '/colors/index.css', [], $version, 'all');
});
