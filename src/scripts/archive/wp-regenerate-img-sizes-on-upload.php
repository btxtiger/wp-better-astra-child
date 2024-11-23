<?php

// Regenerate image sizes when uploading an image
function astc_regenerate_image_sizes_on_upload($attachment_id): void {
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
}

add_action('add_attachment', 'astc_regenerate_image_sizes_on_upload');
