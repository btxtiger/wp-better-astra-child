<?php

// Remove WP character replacement
add_filter('run_wptexturize', '__return_false');

// Set image quality to 85
add_filter('wp_editor_set_quality', function($quality, $mime_type) {
   return 85;
}, 10, 2);

// Disable zoom
add_action('wp_head', function() {
   echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">';
});


// Force delete image sizes when deleting an attachment
add_action('delete_attachment', function($postId) {
   $meta = wp_get_attachment_metadata($postId);
   $uploadDir = wp_upload_dir();
   $baseDir = trailingslashit($uploadDir['basedir']);
   if (!empty($meta['sizes'])) {
      foreach ($meta['sizes'] as $size => $sizeInfo) {
         $sizeFile = path_join($baseDir, $sizeInfo['file']);
         if (file_exists($sizeFile)) {
            unlink($sizeFile);
         }
      }
   }
}, 10, 1);

// Regenerate image sizes when uploading an image
add_action('add_attachment', function($attachment_id) {
   require_once ABSPATH . 'wp-admin/includes/image.php';
   $attachment = get_post($attachment_id);
   $fullsizepath = get_attached_file($attachment_id);
   if (false === $fullsizepath || !file_exists($fullsizepath)) {
      return;
   }
   $metadata = wp_generate_attachment_metadata($attachment_id, $fullsizepath);
   if (is_wp_error($metadata) || empty($metadata)) {
      return;
   }
   wp_update_attachment_metadata($attachment_id, $metadata);
});
