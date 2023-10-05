FROM php:8.2-fpm
RUN apt-get update  \
    && apt-get install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && apt-get install -y --no-install-recommends supervisor \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip


WORKDIR /var/www/app

COPY php.ini /usr/local/etc/php

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -sS 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash \
  && apt install -y symfony-cli
