<?php

function add_astc_override_slot($classes) {
   if (is_array($classes)) {
      $classes[] = 'astc-override';
   } else {
      $classes .= ' astc-override';
   }
   return $classes;
}

// Add the function to both the frontend and admin body class filters
add_filter('body_class', 'add_astc_override_slot');
add_filter('admin_body_class', 'add_astc_override_slot');
