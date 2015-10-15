FROM php:fpm
MAINTAINER Savvas Nicholas <iamyojimbo@gmail.com>

RUN apt-get update
RUN apt-get install -y --force-yes \
	libssl-dev \
	libmcrypt-dev \
	zlib1g-dev \
	libpq-dev \
	vim

RUN docker-php-ext-install mcrypt opcache zip mbstring pdo pdo_pgsql pdo_mysql tokenizer

ADD php-fpm.conf /usr/local/etc/php-fpm.conf
ADD php.ini /usr/local/etc/php/php.ini

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel 5
RUN composer global require "laravel/installer=~1.1"

env PATH /root/.composer/vendor/bin:$PATH