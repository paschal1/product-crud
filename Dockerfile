# Use PHP 8.2 with FPM as the base image
FROM php:8.2-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    nginx \
    && docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Node.js and npm for Vite (frontend asset compilation)
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install PHP dependencies (including laravel/breeze)
RUN composer install --optimize-autoloader

# Build frontend assets (for Vite/Breeze)
RUN npm install && npm run build

# Set file permissions for Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Redirect Laravel logs to stdout for Render
RUN ln -sf /dev/stdout /var/www/storage/logs/laravel.log

# Clear and cache Laravel configurations
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Run database migrations (comment out if manual execution is preferred)
RUN php artisan migrate --force

# Copy Nginx configuration
COPY ./nginx.conf /etc/nginx/sites-available/default

# Expose port 10000 for Render
EXPOSE 10000

# Health check to verify app is running
HEALTHCHECK --interval=30s --timeout=3s \
    CMD curl -f http://localhost:10000/ || exit 1

# Start Nginx and PHP-FPM
CMD service nginx start && php-fpm