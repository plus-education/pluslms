#!/bin/bash

php artisan optimize:clear
php artisan package:discover --ansi
php artisan event:cache
php artisan config:cache
php artisan route:cache