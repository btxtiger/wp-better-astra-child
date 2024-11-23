<?php

/**
 * This file contains all the functions that are used to optimize the breadcrumbs.
 */

// add_filter( 'astra_breadcrumb_trail_labels', function( $args ) {
//    $args['home'] = __( 'Praxis', 'astra' );
//    return $args;
// });


// Strip the first item from the breadcrumb trail if there are more than 2 items
add_filter('astra_breadcrumb_trail_items', function ($args) {
   if (count($args) > 2) {
      unset($args[0]);
   }

   return $args;
});
