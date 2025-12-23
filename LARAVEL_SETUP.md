# 🚀 Laravel Setup Guide

## ✅ Yes! Laravel Works Perfectly in This Docker Setup

Your Docker environment is fully compatible with Laravel and all modern PHP frameworks!

## 📦 Quick Setup Options

### Option 1: Install Laravel in Existing Setup (Recommended)

```bash
# Enter the PHP container
docker exec -it php-apache bash

# Install Composer dependencies (if not already installed)
# Composer is already pre-installed in the container!

# Create new Laravel project
cd /var/www/html
composer create-project laravel/laravel my-laravel-app

# Set permissions
chown -R www-data:www-data my-laravel-app
chmod -R 755 my-laravel-app/storage
chmod -R 755 my-laravel-app/bootstrap/cache
```

**Access Laravel at:** http://localhost:8080/my-laravel-app/public/

### Option 2: Use Laravel as Root Project

If you want Laravel as your main application:

```bash
# Stop current services
docker-compose down

# Create Laravel project in www folder
cd www
composer create-project laravel/laravel .

# Update docker-compose.yml to point to public folder
# (I can help with this if needed)

# Start services
docker-compose up -d
```

### Option 3: Separate Laravel Service (Advanced)

I can create a separate Laravel service in docker-compose.yml if you prefer.

## 🔧 Laravel Configuration

### 1. Environment File

Create `.env` in your Laravel project:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:YOUR_KEY_HERE
APP_DEBUG=true
APP_URL=http://localhost:8080

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=app_db
DB_USERNAME=developer
DB_PASSWORD=developer123
```

### 2. Database Setup

```bash
# Inside Laravel container
php artisan migrate
```

### 3. Storage Link

```bash
php artisan storage:link
```

## 🎨 Tailwind CSS with Laravel

Laravel has built-in Tailwind support via Laravel Mix or Vite:

```bash
# Install dependencies
npm install

# Install Tailwind
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p

# Build assets
npm run dev
# or for production
npm run build
```

## 📁 Project Structure

```
www/
├── my-laravel-app/
│   ├── app/
│   ├── public/          → http://localhost:8080/my-laravel-app/public/
│   ├── resources/
│   ├── routes/
│   └── ...
├── try/
│   └── index.php        → http://localhost:8080/try/
└── index.php            → http://localhost:8080/
```

## 🛠️ Laravel Commands

```bash
# Enter container
docker exec -it php-apache bash

# Navigate to Laravel project
cd /var/www/html/my-laravel-app

# Run Laravel commands
php artisan migrate
php artisan make:controller MyController
php artisan serve  # (not needed, Apache already serves)
```

## ✅ What Works

- ✅ **CSS/SCSS** - Fully supported
- ✅ **JavaScript** - Fully supported
- ✅ **Tailwind CSS** - Works via CDN or build process
- ✅ **jQuery** - Works perfectly
- ✅ **Laravel Mix/Vite** - Works for asset compilation
- ✅ **Blade Templates** - Fully functional
- ✅ **Eloquent ORM** - Database works perfectly
- ✅ **Artisan Commands** - All commands work
- ✅ **Composer** - Pre-installed
- ✅ **npm/node** - Can be added if needed

## 🚀 Quick Start Example

1. **Create Laravel project:**
   ```bash
   docker exec -it php-apache composer create-project laravel/laravel /var/www/html/laravel
   ```

2. **Set permissions:**
   ```bash
   docker exec -it php-apache chown -R www-data:www-data /var/www/html/laravel
   docker exec -it php-apache chmod -R 755 /var/www/html/laravel/storage
   ```

3. **Access:** http://localhost:8080/laravel/public/

## 💡 Pro Tips

1. **Use Laravel Valet alternative:** Your Docker setup works the same way
2. **Hot Module Replacement:** Use Laravel Mix or Vite for HMR
3. **Database:** Already configured - just update `.env`
4. **Queue Workers:** Can run `php artisan queue:work` in container
5. **Scheduler:** Set up cron in container for `php artisan schedule:run`

## 🐛 Troubleshooting

**Permission Issues:**
```bash
docker exec -it php-apache chown -R www-data:www-data /var/www/html
docker exec -it php-apache chmod -R 755 /var/www/html
```

**Composer Issues:**
```bash
docker exec -it php-apache composer install --no-interaction
```

**Cache Issues:**
```bash
docker exec -it php-apache php artisan config:clear
docker exec -it php-apache php artisan cache:clear
```

---

**Everything works exactly like XAMPP, but better! 🎉**

