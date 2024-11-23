<?php

// Load CDN javascript library in document head in CF7 edit page
add_action('admin_head', function () {
   echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ace.js" integrity="sha512-oz/97HdPI510jvvYzVqE2tzz+jWpvUeVkK5OT0S2kPZOxuR+9cE8zT1V6UgwtRG71ThICBEtkPEzN5tfP/YeYw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
   echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/mode-html.min.js" integrity="sha512-XGHrDrpn23J6mbzYjpOgXXnGIpNRiegMTu+irRxE9KofOh3lnGNBW4q9x8J8ppempFTWVIEJzxwarbV2/M1lCQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
   echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/mode-css.min.js" integrity="sha512-q2Qu7dOhudjAQ8wvsLOsZ1NyUhOPAeGL/jzO1f45NMFGSv9F6sgDyzWa00LCVBWg/p84nGM/NHOX4bO1ctbkKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
   echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-language_tools.min.js" integrity="sha512-iK7yTkCkv7MbFwTqRgHTbmIqoiiLq6BsyNjymnFyB5a7pEQwYThj9QIgqBy9+XPPwj7+hAEHyR2npOHL1bz4Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
   echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-emmet.min.js" integrity="sha512-bsLLbFnnbjDUWKA6adr3cO61B93PyVG65rDNJSIEKkBFj45PqtUEMCq56+ofI6tir1m4FDOFVSPIE9nzhMOmCQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
   echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-inline_autocomplete.min.js" integrity="sha512-kbnnJPlQtUZdt6nZYK83fPWWnlMNRXoAqqO20G+ylWDZc39BuUkmasp2ogL60o9QiN22DhYnPPID7g2V2qJuPw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
   echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/theme-one_dark.min.js" integrity="sha512-IzwM6BfvrK5Yt8SGQXeP/k6CHHMQRsjHHiqf3txqNuAA1fOIZa1aQEWBsY9X+X+xF60e8xuSIQbNhmFmiaxs4Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
   echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-error_marker.min.js" integrity="sha512-4J/0fXV7jbSwrb4fio0hSnjUgwbQaznUWkeeV/MyVq5O+kFMPDmDOddUJz/Log6cGJ3sCMheo0gvrathVL6Ylg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
   echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.15.1/beautify-html.min.js" integrity="sha512-9oipLBY8N19ej4XlfPFHfdKkqn8FnAEsucbkycMoLthN77bImVWZ0GtLMfCrXBqpTetBn2eM9N1pliZJC7IrNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
});


// Load custom javascript in document footer in CF7 edit page
add_action('admin_footer', function () {
   echo '<script src="' . get_stylesheet_directory_uri() . '/scripts/cf7-ace-editor-config.js"></script>';
   echo '<style>.tag-generator-panel input.insert-tag { display: none; }</style>';
});
