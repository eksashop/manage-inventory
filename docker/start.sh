#!/bin/sh

sed -i "s/{{PORT}}/${PORT:-80}/g" /etc/nginx/http.d/default.conf

php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache
chown -R www-data:www-data /var/www/html/storage

php artisan migrate --force

php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf