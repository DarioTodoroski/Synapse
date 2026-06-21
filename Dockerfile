FROM composer:2 AS vendor

WORKDIR /app

RUN docker-php-ext-install pdo_mysql

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader

COPY . .
RUN composer dump-autoload --optimize

FROM node:22-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json vite.config.js postcss.config.cjs tailwind.config.js ./
COPY resources ./resources
COPY public ./public
RUN npm ci
RUN npm run build

FROM php:8.4-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
ENV PORT=8080

RUN apt-get update \
    && apt-get install -y --no-install-recommends default-mysql-client libzip-dev unzip \
    && docker-php-ext-install pdo_mysql zip \
    && a2dismod mpm_event mpm_worker \
    && a2enmod mpm_prefork \
    && a2enmod rewrite \
    && sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/*.conf \
    && printf "ServerName localhost\n<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>\n" > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY --from=vendor /app /var/www/html
COPY --from=frontend /app/public/build /var/www/html/public/build
COPY docker/entrypoint.sh /usr/local/bin/synapse-entrypoint

RUN chmod +x /usr/local/bin/synapse-entrypoint \
    && mkdir -p storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8080

ENTRYPOINT ["synapse-entrypoint"]
CMD ["apache2-foreground"]
