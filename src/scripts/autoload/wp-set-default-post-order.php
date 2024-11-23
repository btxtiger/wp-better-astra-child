<?php

// Set the default post order in admin area
function set_post_order_in_admin($wp_query) {
   global $pagenow;

   if (is_admin() && 'edit.php' == $pagenow && !isset($_GET['orderby'])) {
      $wp_query->set('orderby', 'modified'); // Changed from 'title' to 'modified'
      $wp_query->set('order', 'DESC'); // Posts will be shown from most recently modified to least
   }
}
add_filter('pre_get_posts', 'set_post_order_in_admin', 5);
