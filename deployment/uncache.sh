#!/bin/bash

php artisan optimize:clear
php artisan package:discover --ansi
php artisan event:clear
php artisan config:clear
php artisan route:clear