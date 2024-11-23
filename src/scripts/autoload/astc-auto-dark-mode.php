<?php

function astc_add_base_light_mode() {
   ?>
   <script>
      function astc_ensureOverrideLast() {
         const body = document.body;
         body?.classList?.remove('astc-override');
         body?.classList?.add('astc-override');
      }

      (function astc_addLightMode() {
         // Always add the light class
         document.documentElement.classList.add('light');
      })();
   </script>
   <?php
}

function astc_add_auto_dark_mode() {
   ?>
   <script>
      (function astc_addAutoDarkMode() {
         const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');

         function astc_applyDarkMode() {
            if (window.location.href.indexOf('customize_changeset_uuid') !== -1 ||
               window.location.href.indexOf('/wp-admin') !== -1) {
               return; // Skip in Customizer and Admin area
            }

            if (prefersDarkScheme.matches) {
               document.documentElement.classList.add('dark');
            } else {
               document.documentElement.classList.remove('dark');
            }

            astc_ensureOverrideLast(); // Ensure astc-override is the last class
         }

         // Apply dark mode on load
         astc_applyDarkMode();

         // Listen for changes in system color scheme and reapply
         prefersDarkScheme.addEventListener('change', astc_applyDarkMode);
      })();
   </script>
   <?php
}

function astc_add_footer_scripts() {
   ?>
   <script>
      document.addEventListener('DOMContentLoaded', astc_ensureOverrideLast);
   </script>
   <?php
}

add_action('wp_head', 'astc_add_base_light_mode');
add_action('admin_head', 'astc_add_base_light_mode');

if (!defined('ASTC_NO_DARK_MODE') || ASTC_NO_DARK_MODE !== true) {
   add_action('wp_head', 'astc_add_auto_dark_mode');
   add_action('admin_head', 'astc_add_auto_dark_mode');
}

add_action('wp_footer', 'astc_add_footer_scripts');
add_action('admin_footer', 'astc_add_footer_scripts');
