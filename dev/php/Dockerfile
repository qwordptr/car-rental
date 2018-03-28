FROM php:7.1-fpm

RUN apt-get update && apt-get install -y \
    openssl \
    git \
    unzip 

RUN docker-php-ext-install pdo_mysql
    
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version
RUN echo 'alias sf="php bin/console"' >> ~/.bashrc

WORKDIR "/var/www/symfony"
