FROM php:8.1-apache

RUN apt-get update && apt-get install -y vim unzip libicu-dev git \
    && docker-php-ext-install intl pdo_mysql 

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer