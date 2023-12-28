FROM composer as composer

WORKDIR /var/www

COPY composer.json composer.lock ./
RUN set -eux; \
    COMPOSER_ALLOW_SUPERUSER=1 composer install --no-cache --no-progress --no-interaction --no-ansi;

FROM php:8.2.2-fpm

RUN apt-get update \
    && apt-get install -qq libfcgi-bin libpq-dev libicu-dev \
    && apt-get clean

WORKDIR /var/www

COPY --link --from=composer /var/www/vendor /var/www/vendor

RUN mkdir -p /var/www/var \
    && chown -R www-data:www-data /var/www/var

VOLUME /var/www/vendor /var/www/var
