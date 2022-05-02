#!/bin/bash

rm -rf ./vendor/

composer install --no-dev --no-interaction --prefer-dist --ignore-platform-reqs --optimize-autoloader --apcu-autoloader --ansi --no-scripts

php artisan migrate --force

./deployment/recache.sh