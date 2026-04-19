FROM php:8.2-cli

# Installer les extensions PHP
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev nodejs npm \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Installer les dépendances JS et builder les assets
RUN npm install && npm run build

# Permissions
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8000

CMD php artisan storage:link && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000