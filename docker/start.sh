#!/bin/sh

sed -i "s/{{PORT}}/${PORT:-80}/g" /etc/nginx/http.d/default.conf

php artisan migrate --force

php artisan config:cache
php artisan route:cache
php artisan view:cache

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf