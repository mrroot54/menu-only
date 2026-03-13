# 1. Use PHP 8.4
FROM php:8.4-cli

# 2. Set standard Laravel directory (Changed from /app to /var/www)
WORKDIR /var/www

# 3. Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql

# 4. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Copy files
COPY . .

# 6. Install Dependencies
RUN composer install --no-dev --optimize-autoloader

# 7. IMPORTANT: Set Permissions (Fix for 500 Error)
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage

# 8. Run Server
CMD php -S 0.0.0.0:$PORT -t public
