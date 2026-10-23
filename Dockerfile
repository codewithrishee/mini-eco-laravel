
FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libjpeg62-turbo-dev \
    libfreetype6-dev libonig-dev libxml2-dev curl \
    nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && a2enmod rewrite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction \
    && npm ci \
    && npm run build \
    && chown -R www-data:www-data storage bootstrap/cache

RUN printf '%s\n' \
    '<?php' \
    '$port = getenv("PORT") ?: "10000";' \
    'file_put_contents("/etc/apache2/ports.conf", "Listen " . intval($port) . "\n");' \
    'file_put_contents("/etc/apache2/sites-available/000-default.conf", "<VirtualHost *:" . intval($port) . ">\nDocumentRoot /var/www/html/public\n<Directory /var/www/html/public>\nAllowOverride All\nRequire all granted\n</Directory>\n</VirtualHost>\n");' \
    '?>' > /tmp/configure.php

RUN printf '%s\n' \
    '#!/bin/sh' \
    'set -e' \
    'php /tmp/configure.php' \
    'mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views bootstrap/cache' \
    'chown -R www-data:www-data storage bootstrap/cache' \
    'exec apache2-foreground' \
    > /usr/local/bin/start-app \
    && chmod +x /usr/local/bin/start-app

EXPOSE 10000

CMD ["/usr/local/bin/start-app"]
