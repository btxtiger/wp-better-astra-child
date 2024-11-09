<?php
/**
 * Remove Astra extra spacing
 */
add_filter('astra_stretched_layout_with_spacing', '__return_false');

/**
 * Common function to enqueue styles
 */
function wp_better_astra_enqueue_theme($dependencies) {
   $version = CHILD_THEME_WP_BETTER_ASTRA_CHILD_VERSION;

   // wp_enqueue_style('wp-better-astra-child-colors-compatibility-v1', get_stylesheet_directory_uri() . '/colors/compatibility-v1.css', $dependencies, $version, 'all');

   $customThemeDir = WP_CONTENT_DIR . '/uploads/astc-colors';
   if (is_dir($customThemeDir) && ($files = glob("$customThemeDir/*.css"))) {
      usort($files, static function ($a, $b) {
         return strpos($a, 'dark') !== false ? 1 : -1;
      });
      foreach ($files as $file) {
         $fileUrl = content_url(str_replace(WP_CONTENT_DIR, '', $file));

         // if file data contains string '.light', replace it with ':root'
         /**
          * We need:
          * :root:not(.dark).light
          * :root.light.dark
          */

         // $fileContent = file_get_contents($file);
         // $fileContent = preg_replace('/^\s*\.light\s*{\s*$/m', ':root:not(.dark).light {', $fileContent);
         // $fileContent = preg_replace('/^\s*\.dark\s*{\s*$/m', ':root.light.dark {', $fileContent);
         // file_put_contents($file, $fileContent);

         wp_enqueue_style("wp-better-astra-child-custom-" . pathinfo($file, PATHINFO_FILENAME), $fileUrl, $dependencies, $version, 'all');
      }
   } else {
      wp_enqueue_style('wp-better-astra-child-colors-default-palette', get_stylesheet_directory_uri() . '/colors/md-default-palette.css', $dependencies, $version, 'all');
   }

   wp_enqueue_style('wp-better-astra-child-colors-theme-index', get_stylesheet_directory_uri() . '/colors/theme-index.css', $dependencies, $version, 'all');
}

// Hook for frontend
add_action('wp_enqueue_scripts', function () {
   wp_better_astra_enqueue_theme(['astra-theme-css']);
   wp_enqueue_style('wp-better-astra-child-plugin-fixes', get_stylesheet_directory_uri() . '/styles/index.css', ['astra-theme-css'], CHILD_THEME_WP_BETTER_ASTRA_CHILD_VERSION, 'all');
}, 15);

// Hook for admin areas
add_action('admin_enqueue_scripts', function () {
   wp_better_astra_enqueue_theme([]);
});
add_action('customize_controls_enqueue_scripts', function () {
   wp_better_astra_enqueue_theme([]);
   wp_enqueue_script('wp-better-astra-child-customizer', get_stylesheet_directory_uri() . '/admin/customizer.js', ['customize-controls'], CHILD_THEME_WP_BETTER_ASTRA_CHILD_VERSION, true);
});

