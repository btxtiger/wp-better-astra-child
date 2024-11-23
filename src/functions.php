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

// Autoload all scripts form scripts/autoload directory using DirectoryIterator including subdirectories
$directory = get_stylesheet_directory() . '/scripts/autoload/';
$phpFiles = [];
$iterator = new RecursiveIteratorIterator(
   new RecursiveDirectoryIterator($directory)
);

foreach ($iterator as $file) {
   if ($file->isFile() && $file->getExtension() === 'php') {
      $phpFiles[] = $file->getPathname();
      require_once $file->getPathname();
   }
}
