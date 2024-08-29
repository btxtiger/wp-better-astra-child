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

require_once get_stylesheet_directory() . '/scripts/handle-dark-mode.php';
require_once get_stylesheet_directory() . '/scripts/override-variables.php';
require_once get_stylesheet_directory() . '/scripts/wordpress.php';
require_once get_stylesheet_directory() . '/scripts/astra.php';

require_once get_stylesheet_directory() . '/scripts/fontawesome.php';

require_once get_stylesheet_directory() . '/scripts/cf7.php';
require_once get_stylesheet_directory() . '/scripts/cf7-editor.php';

require_once get_stylesheet_directory() . '/scripts/wp-admin.php';
//require_once get_stylesheet_directory() . '/scripts/wp-github-updater.php';

// Autoload all scripts form scripts/autoload directory using DirectoryIterator including subdirectories
foreach (glob(get_stylesheet_directory() . '/scripts/autoload/**/*.php', GLOB_BRACE) as $autoloadFile) {
   require_once $autoloadFile;
}

