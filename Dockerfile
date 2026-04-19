FROM php:8.2-apache

# Installer les extensions PHP
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev nodejs npm \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath

# Activer mod_rewrite pour Laravel
RUN a2enmod rewrite

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Installer les dépendances
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Permissions
RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Configurer Apache pour pointer vers /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN echo "Listen 8000" >> /etc/apache2/ports.conf && sed -i 's/VirtualHost \*:80/VirtualHost *:8000/' /etc/apache2/sites-available/000-default.conf

EXPOSE 8000

CMD php artisan storage:link && php artisan migrate --force && apache2-foreground