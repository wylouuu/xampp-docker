# ===========================================
# PHP 8.3 with Apache - Custom Build
# ===========================================
FROM php:8.3-apache

# Set environment variables
ENV DEBIAN_FRONTEND=noninteractive
ENV APACHE_DOCUMENT_ROOT=/var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    libxpm-dev \
    libgmp-dev \
    libldap2-dev \
    libsasl2-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    libicu-dev \
    libpq-dev \
    libsqlite3-dev \
    libbz2-dev \
    libreadline-dev \
    libxslt1-dev \
    zip \
    unzip \
    nano \
    vim \
    && rm -rf /var/lib/apt/lists/*

# Configure and install PHP extensions
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp \
    --with-xpm

# Install common PHP extensions
RUN docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_mysql \
    mysqli \
    gd \
    mbstring \
    xml \
    bcmath \
    zip \
    exif \
    pcntl \
    intl \
    opcache \
    soap \
    bz2 \
    calendar \
    gettext \
    shmop \
    sockets \
    sysvmsg \
    sysvsem \
    sysvshm \
    xsl \
    gmp

# Install additional extensions via PECL
RUN pecl install redis apcu \
    && docker-php-ext-enable redis apcu

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache modules
RUN a2enmod rewrite headers expires deflate ssl

# Set Apache ServerName to suppress warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Configure Apache timeout (for long-running scripts)
RUN echo "Timeout 600" >> /etc/apache2/apache2.conf

# Set working directory
WORKDIR /var/www/html

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

# Expose ports
EXPOSE 80 8080

# Start Apache
CMD ["apache2-foreground"]

