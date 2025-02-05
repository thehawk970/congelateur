FROM dunglas/frankenphp:latest

RUN install-php-extensions \
	pdo_mysql \
	pdo_pgsql \
	gd \
	intl \
	zip \
	opcache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1


COPY . /app

RUN cp .env.prod .env.local
RUN composer install --no-dev --optimize-autoloader