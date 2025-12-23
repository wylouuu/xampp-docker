# 🔄 Live Reload & File Access Guide

## ✅ Your Setup is Already Configured for Live Reload!

The Docker setup uses **volume mounts**, which means:
- ✅ **Changes are reflected immediately** - No restart needed!
- ✅ **PHP files are synced in real-time** between your host and container
- ✅ **OPcache is configured** to check for changes on every request

## 📁 How to Access Your Files

### URL Structure

Your `www/` folder is mapped to the web root. Here's how URLs work:

```
www/
├── index.php          → http://localhost:8080/
├── try/
│   └── index.php      → http://localhost:8080/try/
└── api/
    └── test.php       → http://localhost:8080/api/test.php
```

### Examples

| File Path | URL |
|-----------|-----|
| `www/index.php` | http://localhost:8080/ |
| `www/try/index.php` | http://localhost:8080/try/ |
| `www/try/index.php` | http://localhost:8080/try/index.php |
| `www/api/users.php` | http://localhost:8080/api/users.php |

## 🔧 Live Reload Configuration

### What's Already Configured:

1. **OPcache Revalidation**: Set to `0` (checks on every request)
   ```ini
   opcache.revalidate_freq = 0
   ```

2. **No Browser Caching**: `.htaccess` disables caching for PHP files

3. **Volume Mounts**: Files are synced in real-time

### How It Works:

1. **Edit a file** in `www/` folder
2. **Save the file**
3. **Refresh browser** (Ctrl+F5 or Cmd+Shift+R for hard refresh)
4. **Changes appear immediately!** ✨

## 🐛 Troubleshooting

### Issue: Changes Not Appearing

**Solution 1: Hard Refresh Browser**
- **Windows/Linux**: `Ctrl + F5` or `Ctrl + Shift + R`
- **Mac**: `Cmd + Shift + R`

**Solution 2: Clear OPcache**
```bash
# Enter the container
docker exec -it php-apache bash

# Clear OPcache (inside container)
php -r "opcache_reset();"
```

**Solution 3: Restart Web Service**
```bash
docker-compose restart web
```

### Issue: Can't Access Subdirectory

**Check the URL:**
- ✅ Correct: `http://localhost:8080/try/`
- ✅ Also works: `http://localhost:8080/try/index.php`
- ❌ Wrong: `http://localhost:8080/www/try/` (www is the root!)

**Check File Permissions:**
```bash
# Files should be readable
chmod 644 www/try/index.php
chmod 755 www/try/
```

### Issue: 404 Not Found

**Check:**
1. File exists in `www/` folder (not outside)
2. File has `.php` extension
3. URL matches the folder structure
4. Apache is running: `docker-compose ps`

## 🧪 Test Your Setup

### Test 1: Access try folder
```bash
curl http://localhost:8080/try/
# Should output: coba
```

### Test 2: Live Reload Test
1. Edit `www/try/index.php`:
   ```php
   <?php echo "Hello from live reload!"; ?>
   ```
2. Save the file
3. Hard refresh browser: `Ctrl + F5`
4. Should see new content immediately!

### Test 3: Check OPcache Status
```bash
docker exec php-apache php -r "var_dump(opcache_get_status());"
```

## 📝 Best Practices

1. **Always use hard refresh** during development (Ctrl+F5)
2. **Check browser console** for any errors
3. **Use absolute paths** in PHP: `/var/www/html/` (inside container)
4. **Use relative paths** for URLs: `/try/` not `/www/try/`

## 🚀 Quick Commands

```bash
# View Apache logs (real-time)
docker-compose logs -f web

# Check if file is accessible
curl http://localhost:8080/try/

# Enter container to debug
docker exec -it php-apache bash

# Restart web service
docker-compose restart web

# Check service status
docker-compose ps
```

## 💡 Pro Tips

1. **Use a code editor** that auto-saves (VS Code, PhpStorm, etc.)
2. **Enable browser DevTools** to see network requests
3. **Check Apache error logs** if something doesn't work:
   ```bash
   docker-compose logs web | grep -i error
   ```
4. **For production**, change `opcache.revalidate_freq` back to `2` or higher for better performance

---

**Your `try` folder is accessible at: http://localhost:8080/try/**

Try it now! 🎉

