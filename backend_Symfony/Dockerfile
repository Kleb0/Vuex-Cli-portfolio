FROM php:8.2-fpm

WORKDIR /var/www/symfony

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libicu-dev \
    libpq-dev \
    && docker-php-ext-install intl pdo pdo_mysql

COPY . .
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony
RUN composer install
RUN composer install --no-scripts

CMD ["symfony", "local:server:start", "--no-tls", "--allow-all-ip", "--port", "8000"]

