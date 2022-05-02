#!/bin/bash

./deployment/uncache.sh

rm -rf ./vendor/

composer install --no-dev --no-interaction --prefer-dist --ignore-platform-reqs --optimize-autoloader --apcu-autoloader --ansi --no-scripts

php artisan clear-compiled 
composer dump-autoload
php artisan optimize

php artisan migrate --force

./deployment/recache.sh