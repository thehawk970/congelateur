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
RUN php bin/console cache:warmup && php bin/console asset-map:compile

# Install PostgreSQL 16

RUN apt update && apt install -y \
    wget \
    gnupg \
    lsb-release \
    sudo \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

RUN wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | gpg --dearmor -o /usr/share/keyrings/postgresql-archive-keyring.gpg

RUN echo "deb [signed-by=/usr/share/keyrings/postgresql-archive-keyring.gpg] http://apt.postgresql.org/pub/repos/apt $(lsb_release -cs)-pgdg main" > /etc/apt/sources.list.d/pgdg.list

RUN apt update && apt install -y \
    postgresql-client-16 \
    && rm -rf /var/lib/apt/lists/*
