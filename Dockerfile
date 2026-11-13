FROM php:8.3-fpm-bookworm AS php-base

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libicu-dev \
        libonig-dev \
        libxml2-dev \
        libzip-dev \
        unzip \
    && docker-php-ext-install -j"$(nproc)" bcmath intl mbstring opcache pdo_mysql xml zip \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html
COPY docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

FROM php-base AS development

COPY --from=composer:2.8 /usr/bin/composer /usr/local/bin/composer
COPY docker/php/dev-entrypoint.sh /usr/local/bin/dev-entrypoint
RUN mkdir -p vendor storage/app/public storage/framework/cache/data \
        storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chown -R www-data:www-data vendor storage bootstrap/cache
ENV HOME=/tmp COMPOSER_HOME=/tmp/composer
USER www-data
ENTRYPOINT ["sh", "/usr/local/bin/dev-entrypoint"]
CMD ["php-fpm", "-F"]

FROM node:22-alpine AS development-vite

WORKDIR /var/www/html/frontend
COPY frontend/package.json frontend/package-lock.json ./
RUN npm ci \
    && chown -R node:node /var/www/html
USER node
CMD ["npm", "run", "dev", "--", "--host", "0.0.0.0"]

FROM php-base AS composer-dependencies

COPY --from=composer:2.8 /usr/bin/composer /usr/local/bin/composer
WORKDIR /var/www/html
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress \
    --no-scripts --no-autoloader
COPY app/ ./app/
COPY artisan ./
COPY bootstrap/ ./bootstrap/
COPY config/ ./config/
COPY database/ ./database/
COPY lang/ ./lang/
COPY resources/ ./resources/
COPY routes/ ./routes/
RUN mkdir -p bootstrap/cache storage/framework/cache/data storage/framework/sessions \
        storage/framework/views storage/logs storage/app/public \
    && chmod -R 0775 bootstrap/cache storage \
    && composer dump-autoload --no-dev --classmap-authoritative --no-interaction

FROM node:22-alpine AS frontend-build

WORKDIR /var/www/html/frontend
COPY frontend/package.json frontend/package-lock.json ./
RUN npm ci
COPY frontend/ ./
RUN npm run build

FROM php-base AS production-app

WORKDIR /var/www/html
COPY --chown=www-data:www-data app/ ./app/
COPY --chown=www-data:www-data artisan ./
COPY --chown=www-data:www-data bootstrap/ ./bootstrap/
COPY --chown=www-data:www-data config/ ./config/
COPY --chown=www-data:www-data database/ ./database/
COPY --chown=www-data:www-data lang/ ./lang/
COPY --chown=www-data:www-data public/ ./public/
COPY --chown=www-data:www-data resources/ ./resources/
COPY --chown=www-data:www-data routes/ ./routes/
COPY --from=composer-dependencies --chown=www-data:www-data \
    /var/www/html/vendor ./vendor
COPY --from=frontend-build --chown=www-data:www-data \
    /var/www/html/public/spa ./public/spa
COPY docker/php/production.ini /usr/local/etc/php/conf.d/zz-production.ini
COPY docker/php/production-entrypoint.sh /usr/local/bin/app-entrypoint
RUN mkdir -p bootstrap/cache storage/framework/cache/data storage/framework/sessions \
        storage/framework/views storage/logs storage/app/public \
    && chown -R www-data:www-data bootstrap/cache storage
USER www-data
EXPOSE 9000
ENTRYPOINT ["sh", "/usr/local/bin/app-entrypoint"]
CMD ["php-fpm", "-F"]
HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
    CMD ["php", "-r", "exit(@fsockopen('127.0.0.1', 9000) ? 0 : 1);"]

FROM nginx:1.28-alpine AS nginx-base

COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/entrypoint.sh /usr/local/bin/nginx-entrypoint
RUN mkdir -p /var/cache/nginx /var/run \
    && chown -R nginx:nginx /var/cache/nginx /var/run /tmp
USER nginx
ENTRYPOINT ["sh", "/usr/local/bin/nginx-entrypoint"]
EXPOSE 8080 8443

FROM nginx-base AS development-nginx

COPY docker/nginx/dev.conf /etc/nginx/conf.d/default.conf.template

FROM nginx-base AS production-nginx

COPY docker/nginx/prod.conf /etc/nginx/conf.d/default.conf.template
COPY --from=production-app --chown=nginx:nginx \
    /var/www/html/public/ /var/www/html/public/
USER root
RUN mkdir -p /var/www/html/storage/app/public \
    && chown -R nginx:nginx /var/www/html
USER nginx
HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
    CMD wget -q --header="Host: $SERVER_NAME" -O /dev/null \
        https://127.0.0.1:8443/ --no-check-certificate
