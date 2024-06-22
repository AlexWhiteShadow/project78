FROM php:8.2.0-apache

COPY ./../../ /var/www/html

COPY ./../../.docker/php-apache/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update

RUN docker-php-ext-install pdo_mysql


RUN curl -sS https://getcomposer.org/installer | \
php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite