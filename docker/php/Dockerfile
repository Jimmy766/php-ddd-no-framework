FROM php:7.4-apache
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
 && docker-php-ext-install pdo_mysql

RUN a2enmod rewrite

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html