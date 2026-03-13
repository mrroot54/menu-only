# 1. Use PHP 8.4 CLI image
FROM php:8.4-cli

# 2. Set working directory
WORKDIR /var/www

# 3. Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql zip

# 4. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Copy existing application files
COPY . .

# 6. Install Laravel dependencies (REMOVED --no-dev)
# Ab ye faker ko bhi install karega
RUN composer install --optimize-autoloader

# 7. Set Permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage

# 8. Expose Port
EXPOSE 8080

# 9. Start Laravel Server
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8080}