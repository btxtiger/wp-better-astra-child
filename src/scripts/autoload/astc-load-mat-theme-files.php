<?php


function wp_better_astra_child_enqueue_theme_styles($dependencies) {
   $version = CHILD_THEME_WP_BETTER_ASTRA_CHILD_VERSION;

   $customThemeDir = content_url('/uploads/astc-colors');

   // Enqueue light.css if available
   if ($lightCssExists = file_exists(WP_CONTENT_DIR . '/uploads/astc-colors/light.css')) {
      wp_enqueue_style('wp-better-astra-child-light', "$customThemeDir/light.css", $dependencies, $version, 'all');
   }

   // Enqueue dark.css if available
   if ($darkCssExists = file_exists(WP_CONTENT_DIR . '/uploads/astc-colors/dark.css')) {
      wp_enqueue_style('wp-better-astra-child-dark', "$customThemeDir/dark.css", $dependencies, $version, 'all');
   }

   // Enqueue fallback styles only if neither light.css nor dark.css is available
   if (!$lightCssExists && !$darkCssExists) {
      wp_enqueue_style('wp-better-astra-child-default-palette', get_stylesheet_directory_uri() . '/colors/md-default-palette.css', $dependencies, $version, 'all');
   }

   // Enqueue other global styles
   wp_enqueue_style('wp-better-astra-child-theme-index', get_stylesheet_directory_uri() . '/colors/theme-index.css', $dependencies, $version, 'all');
}

add_action('wp_enqueue_scripts', function () {
   wp_better_astra_child_enqueue_theme_styles(['astra-theme-css']);
   wp_enqueue_style('wp-better-astra-child-plugin-fixes', get_stylesheet_directory_uri() . '/styles/index.css', ['astra-theme-css'], CHILD_THEME_WP_BETTER_ASTRA_CHILD_VERSION, 'all');
}, 15);

add_action('admin_enqueue_scripts', function () {
   wp_better_astra_child_enqueue_theme_styles([]);
});

add_action('customize_controls_enqueue_scripts', function () {
   wp_better_astra_child_enqueue_theme_styles([]);
   wp_enqueue_script('wp-better-astra-child-customizer', get_stylesheet_directory_uri() . '/admin/customizer.js', ['customize-controls'], CHILD_THEME_WP_BETTER_ASTRA_CHILD_VERSION, true);
});
