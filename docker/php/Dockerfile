FROM php:8.3.2-fpm

RUN apt-get update && apt-get install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip\
    && docker-php-ext-install intl opcache mysqli pdo pdo_mysql\
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY ./app ./
COPY ./.env ./
ENV COMPOSER_ALLOW_SUPERUSER=1
