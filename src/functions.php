<?php
/**
 * WP Better Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP_Better_Astra_Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
$packageVersion = '{{ package.version }}';
if ($packageVersion === '{{ package.version }}') {
   $packageVersion = random_int(10000, 99999);
}
define('CHILD_THEME_WP_BETTER_ASTRA_CHILD_VERSION', $packageVersion);

require_once get_stylesheet_directory() . '/scripts/astra.php';

require_once get_stylesheet_directory() . '/scripts/fontawesome.php';

require_once get_stylesheet_directory() . '/scripts/cf7.php';
require_once get_stylesheet_directory() . '/scripts/cf7-editor.php';

require_once get_stylesheet_directory() . '/scripts/wp-admin.php';
require_once get_stylesheet_directory() . '/scripts/wp-github-updater.php';


function add_dark_mode_script() {
   ?>
   <script>
      if (window.astcNoDarkMode !== false) {
         if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.body.classList.add('dark');
         }
      }
   </script>
   <?php
}
add_action('wp_footer', 'add_dark_mode_script');
