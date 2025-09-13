FROM php:8.2-fpm

# Install system deps + Node + PNPM + PHP extensions
RUN apt-get update && apt-get install -y git curl unzip libzip-dev zip npm && \
    docker-php-ext-install pdo pdo_mysql zip && \
    npm install -g pnpm

WORKDIR /var/www/html
COPY . .

# Install Composer first
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Build frontend assets (now artisan works)
RUN pnpm install
RUN pnpm run build

# Cache Laravel configs/routes/views
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
