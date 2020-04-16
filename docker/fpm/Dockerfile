FROM php:7.2-fpm

RUN apt-get update \
  && apt-get install -y libmemcached-dev zlib1g-dev libicu-dev unzip \
  && pecl install memcached-3.1.3 \
  && docker-php-ext-enable memcached opcache

RUN apt-get update \
  && docker-php-ext-install zip bcmath mbstring pdo  pdo_mysql mysqli mbstring



WORKDIR /var/www/html/NewsHL/web
