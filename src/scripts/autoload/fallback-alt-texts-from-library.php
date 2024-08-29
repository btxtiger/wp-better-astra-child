<?php

/**
 * Replace or add the alt and title attributes of images in the content
 * with those stored in the WordPress media library.
 *
 * @param string $content The post content.
 * @return string The modified post content with updated alt and title attributes.
 */
function replaceImageAltAndTitleWithMediaLibrary(string $content): string {
   // Collect all image IDs from the content
   if (preg_match_all('/wp-image-([0-9]+)/i', $content, $imageIds)) {
      $imageIds = array_unique($imageIds[1]);

      // Retrieve alt texts and titles in one query
      $queryArgs = [
         'include' => $imageIds,
         'post_type' => 'attachment',
         'post_status' => 'inherit',
         'posts_per_page' => -1,
      ];

      $metaData = get_posts($queryArgs);

      $altTexts = [];
      $titleTexts = [];
      foreach ($metaData as $imagePost) {
         $altTexts[$imagePost->ID] = get_post_meta($imagePost->ID, '_wp_attachment_image_alt', true);
         $titleTexts[$imagePost->ID] = $imagePost->post_title;
      }

      // Replace or add the alt and title attributes in the content
      if (preg_match_all('/<img[^>]+>/i', $content, $images)) {
         foreach ($images[0] as $image) {
            if (preg_match('/wp-image-([0-9]+)/i', $image, $imageId)) {
               $imageId = $imageId[1];

               // Replace or add the alt attribute
               // $newAltText = isset($altTexts[$imageId]) ? esc_attr($altTexts[$imageId]) : '';
               // if (preg_match('/alt="[^"]*"/i', $image)) {
               //    $newImage = preg_replace('/alt="[^"]*"/i', 'alt="' . $newAltText . '"', $image);
               // } else {
               //    $newImage = preg_replace('/<img/i', '<img alt="' . $newAltText . '"', $image);
               // }

               // Just add it if it doesn't exist
               if (preg_match('/alt="[^"]+"/i', $image)) {
                  // Do nothing, retain the existing alt attribute if it exists
                  $newImage = $image;
               } else {
                  // If no alt attribute is present, add the alt text from the media library
                  $newAltText = isset($altTexts[$imageId]) ? esc_attr($altTexts[$imageId]) : '';
                  $newImage = preg_replace('/<img/i', '<img alt="' . $newAltText . '"', $image);
               }

               // Replace or add the title attribute
               // if (preg_match('/title="[^"]*"/i', $newImage)) {
               //    $newImage = preg_replace('/title="[^"]*"/i', 'title="' . $newTitleText . '"', $newImage);
               // } else {
               //    $newImage = preg_replace('/<img/i', '<img title="' . $newTitleText . '"', $newImage);
               // }

               // Just add it if it doesn't exist
               if (preg_match('/title="[^"]+"/i', $newImage)) {
                  // Do nothing, retain the existing title attribute if it exists
               } else {
                  $newTitleText = isset($titleTexts[$imageId]) ? esc_attr($titleTexts[$imageId]) : '';
                  $newImage = preg_replace('/<img/i', '<img title="' . $newTitleText . '"', $newImage);
               }

               // Update the content with the new image tag
               $content = str_replace($image, $newImage, $content);
            }
         }
      }
   }

   return $content;
}

// Apply the function to the content filter
add_filter('the_content', 'replaceImageAltAndTitleWithMediaLibrary');
