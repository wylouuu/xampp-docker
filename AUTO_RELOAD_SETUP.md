# 🔄 Auto-Reload Setup Guide

## ✅ Solution 1: JavaScript Auto-Reload (Already Set Up!)

I've created an auto-reload script that automatically refreshes your browser when files change.

### How to Use:

**Option A: Include in your PHP files**
```php
<!DOCTYPE html>
<html>
<head>
    <title>My Page</title>
</head>
<body>
    <h1>Your Content</h1>
    
    <!-- Add this before </body> -->
    <script src="/_auto-reload.js"></script>
</body>
</html>
```

**Option B: Use the helper include**
```php
<?php include '_dev-header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>My Page</title>
</head>
<body>
    <h1>Your Content</h1>
</body>
</html>
```

### Features:
- ✅ Checks for changes every 1 second
- ✅ Shows notification before reload
- ✅ Only works on localhost (disabled in production)
- ✅ Can be controlled via `window.autoReload` in console

### Manual Control:
Open browser console and type:
```javascript
autoReload.disable()  // Disable auto-reload
autoReload.enable()   // Enable auto-reload
autoReload.reload()   // Force reload now
```

---

## 🚀 Solution 2: Browser Extension (Recommended for Better Experience)

### For Chrome/Edge:
1. Install **"Live Server"** or **"Auto Refresh"** extension
2. Or use **"LiveReload"** extension

### For Firefox:
1. Install **"Auto Reload"** extension

### VS Code/Cursor Extension:
1. Install **"Live Server"** extension in Cursor
2. Right-click on your PHP file → "Open with Live Server"

---

## 🎯 Solution 3: BrowserSync (Most Powerful)

I can set up BrowserSync which provides:
- Auto-reload on file changes
- Sync scrolling across devices
- Click/scroll synchronization
- Works with multiple browsers

Would you like me to set this up? It requires adding a service to docker-compose.yml.

---

## 📝 Quick Test

1. Open: http://localhost:8080/try/
2. Edit `www/try/index.php` and save
3. Wait 1-2 seconds
4. Page should auto-refresh! ✨

---

## ⚙️ Configuration

Edit `www/_auto-reload.js` to customize:
- `checkInterval`: How often to check (default: 1000ms = 1 second)
- `showNotification`: Show reload notification (default: true)
- `reloadDelay`: Delay before reload (default: 100ms)

---

## 🐛 Troubleshooting

**Not reloading?**
1. Check browser console for errors
2. Make sure script is included: `<script src="/_auto-reload.js"></script>`
3. Hard refresh once: `Ctrl + F5`
4. Check if auto-reload is enabled: `autoReload.config.enabled` in console

**Too many reloads?**
- Increase `checkInterval` in `_auto-reload.js`
- Or disable: `autoReload.disable()` in console

---

## 💡 Pro Tips

1. **Use Browser DevTools** - Keep console open to see reload notifications
2. **Disable in Production** - The script only runs on localhost
3. **Combine with Hot Module Replacement** - For even faster development
4. **Use VS Code Live Server** - If you prefer editor-based solution

---

**Your `try/index.php` already has auto-reload enabled! Test it now! 🎉**

