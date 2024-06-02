# wp-better-astra-child
A child theme for Astra theme with awesome additional features and customizations.

## Disable the auto dark mode
Add a snippet to your site header:
```html
<script>
    window.astcNoDarkMode = true;
</script>
```

## Set CF7 color
```css
.wpcf7 {
   --ast-global-color-0: black;
}
```
