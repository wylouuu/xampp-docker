<div align="center">

# 🐳 PHP Docker Service

**A Modern XAMPP Alternative - Complete PHP Development Environment**

[![Docker](https://img.shields.io/badge/Docker-20.10+-2496ED?style=for-the-badge&logo=docker&logoColor=white)](https://www.docker.com/)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Apache](https://img.shields.io/badge/Apache-2.4-D22128?style=for-the-badge&logo=apache&logoColor=white)](https://httpd.apache.org/)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

**Built with ❤️ by [Wylou](https://github.com/wylouuu) | [PT. Lunexia Tech Horizon](https://lunexia.id)**

[Features](#-features) • [Quick Start](#-quick-start) • [Documentation](#-documentation) • [Contributing](#-contributing)

</div>

---

## 📖 Overview

**PHP Docker Service** is a production-ready Docker Compose setup that provides a complete PHP development environment, similar to XAMPP but with modern containerization benefits. It includes Apache, PHP 8.3, MySQL 8.0, and phpMyAdmin - everything you need for PHP development in one command.

### Why PHP Docker Service?

- 🚀 **One-Command Setup** - Get started in seconds, not minutes
- 🔄 **Auto-Reload** - Changes reflect immediately without manual refresh
- 🐳 **Docker-Based** - Consistent environment across all machines
- ⚡ **Production-Ready** - Optimized for both development and production
- 🎨 **Framework Support** - Works with Laravel, CodeIgniter, Symfony, and more
- 🔧 **Fully Configurable** - Customize PHP, Apache, and MySQL settings easily
- 📦 **Pre-Installed Extensions** - 20+ PHP extensions ready to use
- 🔒 **Isolated Environment** - No conflicts with system PHP/MySQL

---

## ✨ Features

### Core Services
- ✅ **PHP 8.3** with Apache (mod_php)
- ✅ **MySQL 8.0** with persistent data storage
- ✅ **phpMyAdmin** for database management
- ✅ **Composer** pre-installed for dependency management

### Development Features
- 🔄 **Auto-Reload** - JavaScript-based auto-refresh on file changes
- ⏱️ **Extended Timeouts** - 10 minutes for long-running scripts
- 💾 **Large File Support** - 256MB upload limit, 512MB memory
- 🎯 **Hot Reload** - Changes reflect immediately (no restart needed)
- 📝 **Error Display** - Development-friendly error reporting

### PHP Extensions
Pre-installed and ready to use:
- Database: `pdo`, `pdo_mysql`, `mysqli`
- Image Processing: `gd` (with WebP, JPEG, PNG support)
- String Handling: `mbstring`, `xml`, `xsl`
- Compression: `zip`, `bz2`
- Math: `bcmath`, `gmp`
- Caching: `opcache`, `redis`, `apcu`
- Internationalization: `intl`
- And many more...

### Framework Support
- ✅ Laravel (full support)
- ✅ CodeIgniter
- ✅ Symfony
- ✅ Slim Framework
- ✅ Any PHP framework or vanilla PHP

### Modern Web Technologies
- ✅ CSS/SCSS support
- ✅ JavaScript/jQuery
- ✅ Tailwind CSS
- ✅ Vue.js, React, Alpine.js
- ✅ Bootstrap, Bulma, and other CSS frameworks

---

## 🚀 Quick Start

### Prerequisites

- [Docker](https://www.docker.com/get-started) 20.10+
- [Docker Compose](https://docs.docker.com/compose/install/) 2.0+

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/wylou/php-service.git
   cd php-service
   ```

2. **Configure environment** (optional)
   ```bash
   cp .env.example .env
   # Edit .env to customize ports and credentials
   ```

3. **Start the services**
   ```bash
   docker-compose up -d --build
   ```

4. **Access your services**
   - 🌐 Web Application: http://localhost:8080
   - 🗃️ phpMyAdmin: http://localhost:8888
   - 💾 MySQL: `localhost:3306`

That's it! Your PHP development environment is ready. 🎉

---

## 📁 Project Structure

```
php-service/
├── docker/
│   ├── apache/
│   │   └── vhost.conf          # Apache virtual host configuration
│   ├── mysql/
│   │   └── init/               # SQL initialization scripts
│   └── php/
│       ├── Dockerfile          # Custom PHP 8.3 image
│       └── php.ini             # PHP configuration
├── logs/                       # Apache & MySQL logs
├── www/                        # 📂 Your PHP files go here!
│   ├── index.php               # Welcome page
│   ├── _auto-reload.js         # Auto-reload script
│   └── demo/                   # Demo files
├── .env                        # Environment variables
├── .env.example                # Example environment file
├── docker-compose.yml          # Docker Compose configuration
└── README.md                   # This file
```

---

## 🎯 Usage Examples

### Basic PHP File

Create a file in `www/` folder:

```php
<?php
echo "Hello from PHP Docker Service!";
phpinfo();
?>
```

Access at: http://localhost:8080/your-file.php

### Laravel Project

```bash
# Enter container
docker exec -it php-apache bash

# Create Laravel project
composer create-project laravel/laravel my-app

# Set permissions
chown -R www-data:www-data my-app
chmod -R 755 my-app/storage
```

Access at: http://localhost:8080/my-app/public/

### Database Connection

```php
<?php
$host = 'mysql';  // Use container name
$dbname = 'app_db';
$user = 'developer';
$pass = 'developer123';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
echo "Connected successfully!";
?>
```

### Auto-Reload Setup

Include in your HTML:

```html
<script src="/_auto-reload.js"></script>
```

Changes will auto-refresh in the browser! 🔄

---

## ⚙️ Configuration

### Environment Variables

Edit `.env` file to customize:

```env
# Web Server Ports
WEB_PORT=8080
WEB_PORT_ALT=8081

# MySQL Configuration
MYSQL_PORT=3306
MYSQL_ROOT_PASSWORD=your_secure_password
MYSQL_DATABASE=app_db
MYSQL_USER=developer
MYSQL_PASSWORD=your_password

# phpMyAdmin
PMA_PORT=8888
```

### PHP Configuration

Edit `docker/php/php.ini` to customize PHP settings:

- `max_execution_time = 600` (10 minutes)
- `memory_limit = 512M`
- `upload_max_filesize = 256M`
- `post_max_size = 512M`

### Apache Configuration

Edit `docker/apache/vhost.conf` for Apache settings.

---

## 🔧 Common Commands

```bash
# Start services
docker-compose up -d

# Stop services
docker-compose down

# View logs
docker-compose logs -f

# Restart a service
docker-compose restart web

# Enter PHP container
docker exec -it php-apache bash

# Run Composer
docker exec -it php-apache composer install

# Check service status
docker-compose ps
```

---

## 📚 Documentation

- 📖 [Live Reload Guide](LIVE_RELOAD_GUIDE.md) - Auto-reload setup
- 🎨 [Frameworks Guide](FRAMEWORKS_GUIDE.md) - CSS, JS, frameworks support
- 🚀 [Laravel Setup](LARAVEL_SETUP.md) - Laravel installation guide
- 🔄 [Auto-Reload Setup](AUTO_RELOAD_SETUP.md) - Auto-refresh configuration

---

## 🎨 Demo

Check out the demo page to see CSS, Tailwind, and jQuery in action:

**Demo:** http://localhost:8080/demo/css-demo.php

---

## 🐛 Troubleshooting

### Port Already in Use

Change ports in `.env`:
```env
WEB_PORT=8082
PMA_PORT=8890
```

### Permission Issues

```bash
sudo chown -R $(whoami):$(whoami) www/
```

### MySQL Connection Refused

Wait for MySQL to fully start:
```bash
docker-compose logs mysql
```

### Changes Not Reflecting

1. Hard refresh browser: `Ctrl + F5` (Windows/Linux) or `Cmd + Shift + R` (Mac)
2. Clear OPcache: `docker exec php-apache php -r "opcache_reset();"`
3. Restart web service: `docker-compose restart web`

---

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👨‍💻 Author

**Wylou**

- GitHub: [@wylouuu](https://github.com/wylouuu)
- Email: [lojokowilly.dev@gmail.com](mailto:lojokowilly.dev@gmail.com)

---

## 🏢 Company

**PT. Lunexia Tech Horizon**

- Website: [https://lunexia.id](https://lunexia.id)
- Building innovative tech solutions

---

## 🙏 Acknowledgments

- PHP Community for amazing tools
- Docker team for containerization
- All contributors and users of this project

---

## ⭐ Show Your Support

If this project helped you, please give it a ⭐ on GitHub!

---

<div align="center">

**Made with ❤️ by [Wylou](https://github.com/wylouuu) | [PT. Lunexia Tech Horizon](https://lunexia.id)**

[⬆ Back to Top](#-php-docker-service)

</div>
