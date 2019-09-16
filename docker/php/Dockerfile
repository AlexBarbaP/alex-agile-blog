FROM php:7.2-fpm

MAINTAINER Alex Agile <alexagile@alexagile.com>

ARG WORKDIR

ENV WORKDIR $WORKDIR

# Install repositories
RUN apt-get update && apt-get install -y \
    gnupg
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

# Install dependencies
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libmemcached-dev \
    libzip-dev \
    sqlite3 \
    unzip \
    yarn \
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

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=$WORKDIR \
    && mv composer.phar /usr/local/bin/composer \
    && php -r "unlink('composer-setup.php');"

COPY . $WORKDIR
