# # Use official PHP 8.2 Apache image
# FROM php:8.2-apache

# # Install system dependencies
# RUN apt-get update && apt-get install -y \
#     libpq-dev zip unzip git curl \
#     nodejs npm \
#     && docker-php-ext-install pdo pdo_pgsql \
#     && a2enmod rewrite

# # Set working directory
# WORKDIR /var/www/html

# # Copy project files
# COPY . /var/www/html

# # Install Composer
# COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer
# RUN composer install --no-dev --optimize-autoloader

# # Install Node.js dependencies and build assets
# RUN npm install
# RUN npm run build

# # Set permissions for Laravel
# RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# # Set Apache Document Root to /public
# ENV APACHE_DOCUMENT_ROOT /var/www/html/public
# RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
# RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# # Expose Apache port
# EXPOSE 80

# # Start Apache
# CMD ["apache2-foreground"]


FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev zip unzip git curl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_pgsql \
    && a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Install Node.js dependencies and build assets
RUN npm install || { echo 'npm install failed'; exit 1; }
RUN npm run build || { echo 'npm run build failed'; exit 1; }

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public /var/www/html/public/build
RUN chmod -R 755 /var/www/html/public /var/www/html/public/build

# Clear Laravel caches
RUN php artisan config:cache
RUN php artisan route:cache

# Set Apache Document Root to /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Expose Apache port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]