FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev nodejs npm \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath

RUN a2enmod rewrite

# Les formulaires (photo de profil, couverture) autorisent des fichiers jusqu'à
# 3 Mo côté Laravel : les limites par défaut de PHP (upload_max_filesize=2M)
# sont plus basses et rejetaient silencieusement l'upload avant même que la
# validation Laravel ne s'exécute. On les aligne au-dessus des limites de
# l'application.
RUN { \
        echo 'upload_max_filesize=10M'; \
        echo 'post_max_size=12M'; \
    } > /usr/local/etc/php/conf.d/uploads.ini

# OPcache est fourni par l'image php:8.2-apache mais désactivé par défaut :
# sans lui, PHP recompile tous les fichiers de Laravel à chaque requête au
# lieu de garder leur bytecode en mémoire — un coût énorme et totalement
# évitable pour un framework qui charge autant de fichiers par requête.
# validate_timestamps=0 est sûr ici : un nouveau déploiement démarre un
# nouveau conteneur (donc un cache vide), le code ne change jamais sous un
# conteneur déjà démarré.
RUN docker-php-ext-enable opcache
RUN { \
        echo 'opcache.enable=1'; \
        echo 'opcache.memory_consumption=128'; \
        echo 'opcache.max_accelerated_files=10000'; \
        echo 'opcache.validate_timestamps=0'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data /var/www/html

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN echo '<Directory /var/www/html/public>\n    Options Indexes FollowSymLinks\n    AllowOverride All\n    Require all granted\n</Directory>' >> /etc/apache2/apache2.conf

EXPOSE 80

# config:cache et view:cache évitent de reparser la config et de recompiler
# les vues Blade à chaque requête (même logique qu'OPcache ci-dessus).
# Générés au démarrage du conteneur (pas au build de l'image) car ils ont
# besoin des variables d'environnement réelles (DB_*, CLOUDINARY_*...),
# fournies par Render au runtime, pas disponibles pendant `docker build`.
# route:cache est volontairement absent : plusieurs routes de l'app sont
# définies avec une closure (ex. /langue/{locale}, /bienvenue) et route:cache
# refuse de sérialiser une closure — l'activer plantera le démarrage du
# conteneur tant que ces routes n'auront pas été converties en méthodes de
# contrôleur.
CMD php artisan storage:link && php artisan migrate --force && php artisan app:seed-once && php artisan config:cache && php artisan view:cache && apache2-foreground