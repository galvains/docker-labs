FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

RUN docker-php-ext-install pgsql && docker-php-ext-install mysqli

