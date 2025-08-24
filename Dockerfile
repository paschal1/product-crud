# ---------- Base Image ----------
FROM php:8.2-apache

# ---------- Install System Dependencies ----------
RUN apt-get update && apt-get install -y \
    libpq-dev zip unzip git curl \
    nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql \
    && a2enmod rewrite

# ---------- Set Working Directory ----------
WORKDIR /var/www/html

# ---------- Copy Project Files ----------
COPY . /var/www/html

# ---------- Install Composer ----------
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# ---------- Install Node.js Dependencies ----------
RUN npm install

# ---------- Optional: Production Build ----------
# Uncomment this line if you are building for production
# RUN npm run build

# ---------- Set Permissions ----------
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# ---------- Apache Document Root ----------
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# ---------- Expose Ports ----------
EXPOSE 80      # Apache
EXPOSE 5173    # Vite dev server

# ---------- Start Apache + Vite (Dev Mode) ----------
# In dev, run Vite server for live reload
CMD ["sh", "-c", "npm run dev -- --host 0.0.0.0 & apache2-foreground"]
