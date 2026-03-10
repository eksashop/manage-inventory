FROM node:18-alpine AS node_builder
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

FROM composer:2.6 AS composer_builder
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --ignore-platform-reqs --no-scripts --prefer-dist
COPY . .
RUN composer dump-autoload --optimize

FROM php:8.2-fpm-alpine

RUN apk add --no-cache nginx supervisor \
    && docker-php-ext-install pdo pdo_mysql opcache \
    && mkdir -p /run/nginx

WORKDIR /var/www/html

COPY . .

COPY --from=composer_builder /app/vendor/ ./vendor/
COPY --from=node_builder /app/public/build/ ./public/build/

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/start.sh /usr/local/bin/start.sh

RUN chmod +x /usr/local/bin/start.sh

CMD ["/usr/local/bin/start.sh"]