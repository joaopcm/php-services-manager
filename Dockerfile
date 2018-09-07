FROM php:7.2-apache

ADD . /var/www/html/

RUN a2enmod rewrite
RUN apt-get update && apt-get install -y wget mysql-client
RUN docker-php-ext-install pdo_mysql

RUN apt-get install libldb-dev libldap2-dev unzip git -y \
    && ln -s /usr/lib/x86_64-linux-gnu/libldap.so /usr/lib/libldap.so \
    && ln -s /usr/lib/x86_64-linux-gnu/liblber.so /usr/lib/liblber.so
RUN docker-php-ext-install ldap

RUN wget https://getcomposer.org/download/1.6.5/composer.phar
RUN php composer.phar install