FROM dunglas/frankenphp:1.2.5-php8.3.12-bookworm

ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN apt-get update && apt-get install -y git zip unzip gcc vim
RUN curl -sS https://getcomposer.org/installer | php -- \
        --install-dir=/usr/bin --filename=composer

WORKDIR /app

ENV COMPOSER_ALLOW_SUPERUSER=1

COPY . /app
COPY ./.kamal/web/Caddyfile /etc/caddy/Caddyfile

RUN install-php-extensions gd apcu opcache pdo_mysql pdo_pgsql intl

RUN composer install --prefer-dist
RUN bin/console cache:clear
RUN bin/console asset-map:compile

HEALTHCHECK CMD true
EXPOSE 80 443 2019
