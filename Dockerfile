# 1. Use PHP 8.4 CLI image
# Solved: Ye aapki "PHP version conflict" problem fix karega.
FROM php:8.4-cli

# 2. Set working directory
WORKDIR /var/www

# 3. Install system dependencies and PHP extensions
# Added 'zip' extension for proper Faker/Composer support.
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql zip

# 4. Install Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Copy existing application files
COPY . .

# 6. Install Laravel dependencies
# --no-dev: Production ke liye optimized
RUN composer install --no-dev --optimize-autoloader

# 7. Set Permissions for Laravel storage
# Isse "500 Server Error" nahi aayega.
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage

# 8. Expose Port
# Railway is port ko use karega.
EXPOSE 8080

# 9. Start Laravel Server
# $PORT Railway ka automatic variable hai.
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8080}