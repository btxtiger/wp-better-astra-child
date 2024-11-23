<?php

// Remove WP character replacement
function astc_disable_wptexturize(): bool {
   return false;
}

add_filter('run_wptexturize', 'astc_disable_wptexturize');
