<?php
/**
 * Development Header - Include this in your PHP files for auto-reload
 * 
 * Usage: <?php include '_dev-header.php'; ?>
 * 
 * This adds auto-reload script and development helpers
 */

// Only include in development
$isDev = (
    $_SERVER['HTTP_HOST'] === 'localhost:8080' ||
    $_SERVER['HTTP_HOST'] === 'localhost:8081' ||
    $_SERVER['SERVER_NAME'] === 'localhost' ||
    (isset($_SERVER['HTTP_X_FORWARDED_HOST']) && strpos($_SERVER['HTTP_X_FORWARDED_HOST'], 'localhost') !== false)
);
?>

<?php if ($isDev): ?>
<!-- Auto-Reload Script for Development -->
<script src="/_auto-reload.js"></script>
<script>
    // Add timestamp to prevent caching
    (function() {
        const script = document.querySelector('script[src="/_auto-reload.js"]');
        if (script) {
            script.src = '/_auto-reload.js?v=' + Date.now();
        }
    })();
</script>
<?php endif; ?>

