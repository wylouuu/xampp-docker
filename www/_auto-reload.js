/**
 * Auto-Reload Script for Live Development
 * 
 * This script automatically refreshes the page when files are changed.
 * Include this in your PHP files during development.
 * 
 * Usage: Add this before </body> tag:
 * <script src="/_auto-reload.js"></script>
 */

(function() {
    'use strict';
    
    // Configuration
    const CONFIG = {
        enabled: true,              // Set to false to disable
        checkInterval: 1000,        // Check every 1 second (1000ms)
        debounceTime: 500,          // Wait 500ms after last change before reload
        showNotification: true,     // Show notification before reload
        reloadDelay: 100             // Delay before actual reload (ms)
    };
    
    // Only run in development (not in production)
    if (window.location.hostname === 'localhost' || 
        window.location.hostname === '127.0.0.1' ||
        window.location.port === '8080' ||
        window.location.port === '8081') {
        
        let lastModified = null;
        let reloadTimer = null;
        let isReloading = false;
        
        /**
         * Check if the page has been modified
         */
        function checkForChanges() {
            if (isReloading || !CONFIG.enabled) return;
            
            // Use fetch with cache-busting to check for changes
            fetch(window.location.href + '?__check=' + Date.now(), {
                method: 'HEAD',
                cache: 'no-cache',
                headers: {
                    'Cache-Control': 'no-cache',
                    'Pragma': 'no-cache'
                }
            })
            .then(response => {
                const currentModified = response.headers.get('Last-Modified');
                const etag = response.headers.get('ETag');
                
                if (lastModified === null) {
                    // First check - just store the value
                    lastModified = currentModified || etag || Date.now().toString();
                } else {
                    // Compare with previous value
                    const hasChanged = (currentModified && currentModified !== lastModified) ||
                                     (etag && etag !== lastModified) ||
                                     (!currentModified && !etag);
                    
                    if (hasChanged) {
                        triggerReload();
                    }
                }
            })
            .catch(error => {
                // Silently fail - don't spam console
                console.debug('Auto-reload check failed:', error);
            });
        }
        
        /**
         * Trigger page reload
         */
        function triggerReload() {
            if (isReloading) return;
            isReloading = true;
            
            // Clear any pending timers
            if (reloadTimer) {
                clearTimeout(reloadTimer);
            }
            
            // Show notification if enabled
            if (CONFIG.showNotification) {
                showReloadNotification();
            }
            
            // Reload after delay
            reloadTimer = setTimeout(() => {
                window.location.reload(true); // Force reload from server
            }, CONFIG.reloadDelay);
        }
        
        /**
         * Show reload notification
         */
        function showReloadNotification() {
            // Remove existing notification if any
            const existing = document.getElementById('auto-reload-notification');
            if (existing) {
                existing.remove();
            }
            
            // Create notification element
            const notification = document.createElement('div');
            notification.id = 'auto-reload-notification';
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: #4CAF50;
                color: white;
                padding: 12px 20px;
                border-radius: 4px;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                z-index: 10000;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                font-size: 14px;
                animation: slideIn 0.3s ease-out;
            `;
            notification.textContent = '🔄 Reloading page...';
            
            // Add animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes slideIn {
                    from {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
            `;
            document.head.appendChild(style);
            document.body.appendChild(notification);
            
            // Remove notification after reload
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, CONFIG.reloadDelay + 100);
        }
        
        /**
         * Initialize auto-reload
         */
        function init() {
            if (!CONFIG.enabled) {
                console.log('Auto-reload is disabled');
                return;
            }
            
            console.log('🔄 Auto-reload enabled - checking every ' + CONFIG.checkInterval + 'ms');
            
            // Start checking for changes
            setInterval(checkForChanges, CONFIG.checkInterval);
            
            // Also check on focus (when user switches back to tab)
            window.addEventListener('focus', () => {
                setTimeout(checkForChanges, 100);
            });
            
            // Listen for visibility change
            document.addEventListener('visibilitychange', () => {
                if (!document.hidden) {
                    setTimeout(checkForChanges, 100);
                }
            });
        }
        
        // Start when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
        
        // Expose config for manual control
        window.autoReload = {
            enable: () => { CONFIG.enabled = true; console.log('Auto-reload enabled'); },
            disable: () => { CONFIG.enabled = false; console.log('Auto-reload disabled'); },
            reload: () => { triggerReload(); },
            config: CONFIG
        };
    }
})();

