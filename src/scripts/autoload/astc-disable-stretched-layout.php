<?php

/**
 * Remove Astra extra spacing
 */
function astc_disable_stretched_layout_with_spacing(): bool {
   return false;
}

add_filter('astra_stretched_layout_with_spacing', 'astc_disable_stretched_layout_with_spacing');
