#!/bin/bash

sudo adduser octane www-data
sudo adduser azureuser www-data

sudo mkdir -p storage/framework/{sessions,views,cache} storage/logs bootstrap/cache
sudo chown -R octane:octane storage boostrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache

sudo cp ./deployment/octane/supervisord* /etc/supervisor/conf.d/
sudo cp ./deployment/octane/php.ini /usr/local/etc/php/conf.d/octane.ini
sudo cp ./deployment/octane/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Add cron job for scheduled tasks
(sudo crontab -l ; echo "*/1 * * * * su octane -c \"php /var/www/html/artisan schedule:run --verbose --no-interaction\"")| sudo crontab -

sudo chown -R octane:octane .

# Restart Supervisor
sudo supervisorctl reread && sudo supervisorctl reload