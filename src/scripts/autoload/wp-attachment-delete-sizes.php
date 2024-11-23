<?php

// Force delete image sizes when deleting an attachment
function astc_delete_attachment_files($postId): void {
   $meta = wp_get_attachment_metadata($postId);
   $uploadDir = wp_upload_dir();

   if (!$meta || empty($uploadDir['basedir'])) {
      return;
   }

   $baseDir = trailingslashit($uploadDir['basedir']);

   // Delete all sizes
   if (!empty($meta['sizes']) && is_array($meta['sizes'])) {
      foreach ($meta['sizes'] as $sizeInfo) {
         $sizeFile = path_join($baseDir, $sizeInfo['file']);
         if (file_exists($sizeFile)) {
            unlink($sizeFile);
         }
      }
   }

   // Delete the original file
   if (!empty($meta['file'])) {
      $originalFile = path_join($baseDir, $meta['file']);
      if (file_exists($originalFile)) {
         unlink($originalFile);
      }
   }
}

add_action('delete_attachment', 'astc_delete_attachment_files', 10, 1);
