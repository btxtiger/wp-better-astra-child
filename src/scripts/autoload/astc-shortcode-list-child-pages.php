<?php

/**
 * Usage: [list_child_pages]
 */
function astc_list_child_pages() {
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
add_shortcode('list_child_pages', 'astc_list_child_pages');
