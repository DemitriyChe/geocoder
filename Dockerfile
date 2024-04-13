FROM php:8.1-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    default-mysql-client \
    --no-install-recommends && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    docker-php-ext-install \
        pdo_mysql

COPY . .

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin && \
    composer install && \
    composer clear-cache

USER www-data
