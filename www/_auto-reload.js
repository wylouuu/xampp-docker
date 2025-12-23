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
        checkInterval: 2000,        // Check every 2 seconds (reduced polling)
        showNotification: true,     // Show notification before reload
        reloadDelay: 100            // Delay before actual reload (ms)
    };
    
    // Only run in development (not in production)
    if (window.location.hostname === 'localhost' || 
        window.location.hostname === '127.0.0.1' ||
        window.location.port === '8080' ||
        window.location.port === '8081') {
        
        let lastContentHash = null;
        let reloadTimer = null;
        let isReloading = false;
        let isChecking = false;
        
        /**
         * Simple hash function for content comparison
         */
        function hashContent(str) {
            let hash = 0;
            for (let i = 0; i < str.length; i++) {
                const char = str.charCodeAt(i);
                hash = ((hash << 5) - hash) + char;
                hash = hash & hash; // Convert to 32bit integer
            }
            return hash.toString();
        }
        
        /**
         * Check if the page has been modified by comparing content
         */
        function checkForChanges() {
            if (isReloading || !CONFIG.enabled || isChecking) return;
            
            isChecking = true;
            
            // Fetch the actual page content to compare
            fetch(window.location.href + '?__check=' + Date.now(), {
                method: 'GET',
                cache: 'no-cache',
                headers: {
                    'Cache-Control': 'no-cache',
                    'Pragma': 'no-cache'
                }
            })
            .then(response => response.text())
            .then(content => {
                // Remove the auto-reload script and dynamic content (like timestamps) from comparison
                // This prevents false positives from timestamp changes
                const cleanContent = content
                    .replace(/<script src=["']\/_auto-reload\.js["']><\/script>/g, '')
                    .replace(/\d{2}:\d{2}:\d{2}/g, '') // Remove time stamps HH:MM:SS
                    .trim();
                
                const currentHash = hashContent(cleanContent);
                
                if (lastContentHash === null) {
                    // First check - just store the hash
                    lastContentHash = currentHash;
                    console.debug('Auto-reload: Initial content hash stored');
                } else if (currentHash !== lastContentHash) {
                    // Content actually changed - trigger reload
                    console.log('Auto-reload: File changed, reloading...');
                    triggerReload();
                }
                // If hashes match, do nothing (no spam!)
                
                isChecking = false;
            })
            .catch(error => {
                isChecking = false;
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
            
            console.log('🔄 Auto-reload enabled (content-based detection)');
            
            // Start checking for changes
            setInterval(checkForChanges, CONFIG.checkInterval);
            
            // Check on tab focus (when user switches back)
            window.addEventListener('focus', () => {
                setTimeout(checkForChanges, 300);
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

