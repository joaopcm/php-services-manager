FROM php:7.2-apache

ADD . /var/www/html/

RUN a2enmod rewrite
RUN apt-get update && apt-get install -y wget mysql-client
RUN docker-php-ext-install pdo_mysql
RUN wget https://getcomposer.org/download/1.6.5/composer.phar
RUN php composer.phar install