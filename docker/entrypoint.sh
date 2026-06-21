#!/bin/sh
set -e

mkdir -p \
    storage/app/public \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

chown -R www-data:www-data storage bootstrap/cache

php artisan storage:link >/dev/null 2>&1 || true

if [ "${DB_CONNECTION:-}" != "sqlite" ]; then
    echo "Waiting for database at ${DB_HOST:-db}:${DB_PORT:-3306}..."

    until php <<'PHP'
<?php
$host = getenv('DB_HOST') ?: 'db';
$port = getenv('DB_PORT') ?: '3306';
$database = getenv('DB_DATABASE') ?: 'synapse';
$username = getenv('DB_USERNAME') ?: 'synapse';
$password = getenv('DB_PASSWORD') ?: 'synapse_password';

try {
    new PDO("mysql:host={$host};port={$port};dbname={$database};charset=utf8mb4", $username, $password);
} catch (Throwable $exception) {
    fwrite(STDERR, $exception->getMessage().PHP_EOL);
    exit(1);
}
PHP
    do
        sleep 2
    done
fi

php artisan config:clear --ansi

if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    php artisan migrate --force --ansi
fi

if [ "${1:-}" = "apache2-foreground" ]; then
    rm -f \
        /etc/apache2/mods-enabled/mpm_event.load \
        /etc/apache2/mods-enabled/mpm_event.conf \
        /etc/apache2/mods-enabled/mpm_worker.load \
        /etc/apache2/mods-enabled/mpm_worker.conf

    ln -sf ../mods-available/mpm_prefork.load /etc/apache2/mods-enabled/mpm_prefork.load
    if [ -f /etc/apache2/mods-available/mpm_prefork.conf ]; then
        ln -sf ../mods-available/mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf
    fi

    apache2ctl configtest
fi

exec "$@"
