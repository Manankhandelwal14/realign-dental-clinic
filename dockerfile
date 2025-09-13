# Stage 1 - Build frontend
FROM node:20 AS frontend
WORKDIR /app
COPY package.json pnpm-lock.yaml ./
RUN npm install -g pnpm && pnpm install
COPY . .
RUN pnpm run build

# Stage 2 - Setup Laravel
FROM php:8.2-fpm
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip curl libpq-dev git libzip-dev zip nginx && \
    docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy Laravel
COPY . .

# Copy frontend build into Laravel public
COPY --from=frontend /app/public/build ./public/build

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

EXPOSE 80
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
