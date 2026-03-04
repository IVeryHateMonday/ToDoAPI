FROM php:8.3-fpm

# System packages
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    zip \
    unzip

# PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configure PHP-FPM to listen on all interfaces so Nginx container can reach it
RUN sed -i 's/;listen = 127.0.0.1:9000/listen = 0.0.0.0:9000/' /usr/local/etc/php-fpm.d/www.conf

WORKDIR /var/www

CMD ["php-fpm"]
