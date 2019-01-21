FROM php:7.2-fpm

ARG WORKDIR

ENV WORKDIR $WORKDIR

MAINTAINER Alex Agile <alexagile@alexagile.com>

# Install dependencies
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libmemcached-dev \
    libzip-dev \
    sqlite3 \
    zlib1g-dev

# Install extensions
RUN docker-php-ext-install \
    gd \
    json \
    pdo_mysql \
    zip

# Install pecl extensions
RUN pecl install \
    apcu-beta \
    memcached \
    redis-4.0.1 \
    xdebug-2.6.0

# Configure xdebug extension
COPY ./docker/php/xdebug.ini /tmp/
RUN cat /tmp/xdebug.ini >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && rm -f /tmp/xdebug.ini

# Enable pecl extensions
RUN docker-php-ext-enable \
    apcu \
    memcached \
    redis \
    xdebug

WORKDIR $WORKDIR
