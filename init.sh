#!/usr/bin/env bash

composer install && \
 composer clear-cache && \
 php artisan migrate --force
