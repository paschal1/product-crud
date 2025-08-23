# Use PHP 8.2 with FPM (Fast PHP)
FROM php:8.2-fpm

# Install some tools Laravel needs
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer (for Laravel packages)
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Where our code will live inside the box
WORKDIR /var/www

# Copy all project files into the box
COPY . .

# Install Laravel packages
RUN composer install --no-dev --optimize-autoloader

# Cache Laravel settings
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Open port 10000 (Render needs this)
EXPOSE 10000

# Start Laravel
CMD php artisan serve --host=0.0.0.0 --port=10000
