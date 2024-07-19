# wp-better-astra-child
A child theme for Astra theme with awesome additional features and customizations.

## Disable the auto dark mode
Set the following variable in your wp-config.php
```php
define( 'ASTC_NO_DARK_MODE', true );
```

## Set custom CF7 color
```css
.wpcf7 {
   --astc-form-accent-color: blue;
   --astc-form-accent-color: var(--astc-primary);
}
```
