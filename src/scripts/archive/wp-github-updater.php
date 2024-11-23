<?php

/**
 * Retrieve updates for a WordPress theme from GitHub.
 * Add this snippet to your theme's functions.php file.
 * Note: The public GitHub API has a rate limit of 60 requests per hour per IP.
 */
add_filter('site_transient_update_themes', function($transient) {
// Config
   $wpThemeSlug = 'wp-better-astra-child'; // Change this to your theme slug
   $githubRepoSlug = 'btxtiger/wp-better-astra-child'; // Change this to your GitHub repo slug
   $githubRepoUrl = "https://github.com/$githubRepoSlug";
   $githubReleasesUrl = "https://api.github.com/repos/$githubRepoSlug/releases";

   $cacheFilename = 'github-releases.json';
   $cacheCreatedFilename = 'github-checked-at.txt';

   if (empty($transient->checked)) {
      return $transient;
   }

   // Check if the cache file exists
   $cacheFile = get_theme_file_path($cacheFilename);
   $cacheCreatedFile = get_theme_file_path($cacheCreatedFilename);

   // Check if cache is older than 1 hour
   $isCacheOld = false;
   if (file_exists($cacheCreatedFile)) {
      $cacheCreated = file_get_contents($cacheCreatedFile);
      $cacheCreatedTimestamp = (int)$cacheCreated;
      $currentTimestamp = time();
      $diff = $currentTimestamp - $cacheCreatedTimestamp;
      if ($diff > 3600) { // Cache is old if more than 1 hour
         $isCacheOld = true;
      }
   }

   // Use cached data if available and not old
   if (file_exists($cacheFile) && !$isCacheOld) {
      $releaseData = json_decode(file_get_contents($cacheFile), true);
   } else {
      // Fetch the release data from GitHub
      $response = wp_remote_get($githubReleasesUrl, [
         'timeout' => 10,
         'headers' => [
            'Accept' => 'application/vnd.github.v3+json',
         ],
      ]);
      if (is_wp_error($response)) {
         return $transient;
      }
      $releaseData = json_decode(wp_remote_retrieve_body($response), true);
   }

   if (!empty($releaseData) && !isset($releaseData['message'])) {
      // Cache the response
      file_put_contents($cacheFile, json_encode($releaseData));
      file_put_contents($cacheCreatedFile, time());

      // Get current theme version
      $theme_data = wp_get_theme($wpThemeSlug);
      $currentVersion = $theme_data->Version;

      $latestVersion = ltrim($releaseData[0]['tag_name'], 'v');

      if (version_compare($currentVersion, $latestVersion, '<')) {
         // Find asset in the release data
         $wpAssetKey = false;
         foreach ($releaseData[0]['assets'] as $key => $asset) {
            if (strpos($asset['name'], 'wordpress') !== false) {
               $wpAssetKey = $key;
               break;
            }
         }

         if ($wpAssetKey === false) {
            return $transient;
         }

         $wpAsset = $releaseData[0]['assets'][$wpAssetKey];
         $transient->response[$wpThemeSlug] = [
            'theme' => $wpThemeSlug,
            'new_version' => $latestVersion,
            'url' => $githubRepoUrl,
            'package' => $wpAsset['browser_download_url']
         ];
      }
   }

   return $transient;
});
