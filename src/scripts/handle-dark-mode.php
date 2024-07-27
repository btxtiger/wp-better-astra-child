<?php

function add_light_mode() {
   ?>
   <script>
      document.documentElement.classList.add('light');
   </script>
   <?php
}

function add_auto_dark_mode() {
   ?>
   <script>
      if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
         // If url has no query parameter: customize_changeset_uuid
         if (window.location.href.indexOf('customize_changeset_uuid') !== -1) {
            // do nothing
         }
         else if (window.location.href.indexOf('/wp-admin') !== -1){
            // do nothing
         } else {
            document.documentElement.classList.add('dark');
         }


         // Make sure the astc-override class is the last class in the body tag
         document.body.classList.remove('astc-override');
         document.body.classList.add('astc-override');
      }
   </script>
   <?php
}

add_action('wp_footer', 'add_light_mode');
add_action('admin_footer', 'add_light_mode');

if (defined('ASTC_NO_DARK_MODE') && ASTC_NO_DARK_MODE === true) {
   // Do nothing
} else {
   add_action('wp_footer', 'add_auto_dark_mode');
   add_action('admin_footer', 'add_auto_dark_mode');
}
