#!/bin/bash

# Make log dir
sudo mkdir /var/www/log
sudo chown -R www-data:www-data /var/www/log
sudo chmod 600 /var/www/log

sudo rm /etc/nginx/sites-enabled/default

echo "Replacing nginx configuration for serving PHP 8.1-based applications"
sudo cp ./deployment/nginx.conf /etc/nginx/sites-available/default

sudo ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

echo "Reloading nginx to apply new configuration"
sudo systemctl reload nginx