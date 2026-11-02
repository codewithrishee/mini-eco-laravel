
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

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts \
    && npm ci \
    && npm run build \
    && chown -R www-data:www-data storage bootstrap/cache database

COPY isrgrootx1.pem /usr/local/share/ca-certificates/tidb-ca.crt

RUN update-ca-certificates

RUN printf '%s\n' \
    '#!/bin/sh' \
    'set -e' \
    'PORT="${PORT:-10000}"' \
    'echo "Listen ${PORT}" > /etc/apache2/ports.conf' \
    'printf "<VirtualHost *:%s>\nDocumentRoot /var/www/html/public\n<Directory /var/www/html/public>\nAllowOverride All\nRequire all granted\n</Directory>\n</VirtualHost>\n" "$PORT" > /etc/apache2/sites-available/000-default.conf' \
    'mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views bootstrap/cache' \
    'chown -R www-data:www-data storage bootstrap/cache' \
    'exec apache2-foreground' \
    > /usr/local/bin/start-app \
    && chmod +x /usr/local/bin/start-app

EXPOSE 10000

CMD ["/usr/local/bin/start-app"]
