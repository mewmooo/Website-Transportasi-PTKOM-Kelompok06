FROM php:8.2-alpine

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    sqlite-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_sqlite pdo_mysql gd bcmath zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy BackEnd project files
COPY BackEnd/ /app

# Ensure storage directories exist and have proper permissions
RUN mkdir -p storage/framework/cache/data \
             storage/framework/sessions \
             storage/framework/views \
             storage/logs \
             bootstrap/cache && \
    chmod -R 777 storage bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

EXPOSE 8000

# Start container: setup sqlite, run migrations/seed, ensure app key, and start server
CMD touch database/database.sqlite && \
    chmod 777 database/database.sqlite && \
    if [ -z "$APP_KEY" ]; then php artisan key:generate --force; fi && \
    php artisan migrate --force && \
    php -r "require 'vendor/autoload.php'; \$app = require_once 'bootstrap/app.php'; \$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap(); if (App\Models\User::count() === 0) { Artisan::call('db:seed', ['--force' => true]); }" && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
