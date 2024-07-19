<?php

function add_auto_dark_mode() {
   ?>
   <script>
      if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
         document.body.classList.add('dark');
      } else {
         document.body.classList.add('light');
      }
   </script>
   <?php
}

function add_no_dark_mode() {
   ?>
   <script>
      document.body.classList.add('light');
   </script>
   <?php
}

if (defined('ASTC_NO_DARK_MODE') && ASTC_NO_DARK_MODE === true) {
   add_action('wp_footer', 'add_no_dark_mode');
} else {
   add_action('wp_footer', 'add_auto_dark_mode');
}
