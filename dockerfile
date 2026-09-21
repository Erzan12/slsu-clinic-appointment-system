# -----------------------------
# Stage 1: Build frontend assets
# -----------------------------
FROM node:18 AS node_builder

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build


# -----------------------------
# Stage 2: PHP application
# -----------------------------
FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev zip libpq-dev \
    libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy app
COPY . .

# Copy built assets from Node stage
COPY --from=node_builder /app/public/build ./public/build

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel optimizations
RUN php artisan config:clear && \
    php artisan cache:clear

# Start app
CMD php artisan optimize:clear && \
    php artisan migrate --force && \
    php artisan storage:link && \
    php artisan config:cache && \
    php artisan serve --host=0.0.0.0 --port=10000