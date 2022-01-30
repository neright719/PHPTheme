FROM php:8.0-fpm
ADD ./php.ini /usr/local/etc/php/php.ini

RUN apt-get update \
  && apt-get install -y zlib1g-dev mariadb-client vim libzip-dev \
  && docker-php-ext-install zip pdo_mysql

WORKDIR /var/www