#!/bin/sh

# Set Port Nginx
sed -i "s/{{PORT}}/${PORT:-80}/g" /etc/nginx/http.d/default.conf

# Pastikan folder framework ada (mencegah error View Not Found)
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache
chown -R www-data:www-data /var/www/html/storage

# Jalankan migrasi otomatis
php artisan migrate --force

# Optimasi
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan Supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf