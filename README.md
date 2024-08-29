# wp-better-astra-child
A child theme for Astra theme with awesome additional features and customizations.

## Disable the auto dark mode
Set the following variable in your wp-config.php
```php
define( 'ASTC_NO_DARK_MODE', true );
```

## Set custom theme properties
```css
body.astc-override {
   --astc-default-border-radius: 6px;
}
:root:not(.dark) body.astc-override {
   --astc-site-background: #fffbf5 !important;
}
```

## Set custom CF7 color
```css
.wpcf7 {
   --astc-form-accent-color: blue;
   --astc-form-accent-color: var(--astc-primary);
}
```

## Set a custom theme
1. Configure your theme at https://material-foundation.github.io/material-theme-builder/
2. Change the css selector in light.css to `:root` and in dark.css to `body.dark`
3. Then upload the 2 files to the `wp-content/uploads/astc-colors` directory.


## Customize the root breadcrumb for top level pages
```php
add_filter( 'astra_breadcrumb_trail_labels', function( $args ) {
   $args['home'] = __( 'MyHomeName', 'astra' );
   return $args;
});
```
