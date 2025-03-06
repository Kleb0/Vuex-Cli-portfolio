FROM php:8.2-fpm

WORKDIR /var/www

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev libicu-dev libonig-dev

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installer Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash && \
    mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Copier le projet
COPY . /var/www/

# Changer les permissions
RUN chown -R www-data:www-data /var/www/var

# Installer les dépendances Symfony
RUN composer install --no-dev --optimize-autoloader

# Lancer PHP-FPM (Symfony sera géré par Nginx)
CMD ["php-fpm"]
