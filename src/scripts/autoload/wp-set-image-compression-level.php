<?php

// Set image quality to 85
function astc_set_image_quality($quality, $mime_type): int {
   return 85;
}

add_filter('wp_editor_set_quality', 'astc_set_image_quality', 10, 2);
