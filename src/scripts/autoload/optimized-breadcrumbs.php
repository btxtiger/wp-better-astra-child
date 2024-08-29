<?php

/**
 * This file contains all the functions that are used to optimize the breadcrumbs.
 * Adds the shortcode list_child_pages to list all child pages of the current page.
 */

// add_filter( 'astra_breadcrumb_trail_labels', function( $args ) {
//    $args['home'] = __( 'Praxis', 'astra' );
//    return $args;
// });


add_filter( 'astra_breadcrumb_trail_items' , function ($args) {
   if (count($args) > 2) {
      unset($args[0]);
   }

   return $args;
});

// OTHER
function get_page_path($page_id) {
   $page = get_post($page_id);
   $path = array();
   while ($page->post_parent) {
      $page = get_post($page->post_parent);
      array_unshift($path, '<a href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a>');
   }
   return implode(' > ', $path);
}

function list_child_pages() {
   global $post;
   $child_pages = get_pages(array(
      'child_of' => $post->ID,
      'sort_column' => 'menu_order',
      'sort_order' => 'ASC'
   ));

   $output = '';
   $grouped_pages = array();

   // Group pages by their immediate parent
   foreach ($child_pages as $page) {
      $parent_id = $page->post_parent;
      if (!isset($grouped_pages[$parent_id])) {
         $grouped_pages[$parent_id] = array();
      }
      $grouped_pages[$parent_id][] = $page;
   }

   // Generate output for each group
   foreach ($grouped_pages as $parent_id => $pages) {
      // Skip headline for the first parent (current page)
      if ($parent_id != $post->ID) {
         $parent_page = get_post($parent_id);
         $output .= '<h2><a style="" href="' . get_permalink($parent_page->ID) . '">' . $parent_page->post_title . '</a></h2>';
      }
      $output .= '<ul>';
      foreach ($pages as $page) {
         $output .= '<li><a href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a></li>';
      }
      $output .= '</ul>';
   }

   return $output ? $output : '<p>No child pages found.</p>';
}
add_shortcode('list_child_pages', 'list_child_pages');
