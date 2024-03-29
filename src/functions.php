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
define('CHILD_THEME_WP_BETTER_ASTRA_CHILD_VERSION', '{{ package.version }}');

require_once get_stylesheet_directory() . '/scripts/fontawesome.php';
require_once get_stylesheet_directory() . '/scripts/astra.php';
require_once get_stylesheet_directory() . '/scripts/cf7.php';
require_once get_stylesheet_directory() . '/scripts/cf7-editor.php';
require_once get_stylesheet_directory() . '/scripts/wp-admin.php';
require_once get_stylesheet_directory() . '/scripts/wp-github-updater.php';
