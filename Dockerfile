FROM php:8.2-cli

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs \
    && chmod -R 775 storage bootstrap/cache

RUN php artisan config:clear

EXPOSE 10000

CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT:-10000}"]
