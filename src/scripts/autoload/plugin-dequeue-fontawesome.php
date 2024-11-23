<?php

/**
 * Disable load FontAwesome from CDN
 */
add_action( 'wp_enqueue_scripts', static function () {
   wp_dequeue_style('font-awesome-official');
   wp_deregister_style('font-awesome-official');
}, 20);
