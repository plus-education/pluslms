#!/bin/bash

sudo rm /etc/nginx/sites-enabled/default

echo "Replacing nginx configuration for serving PHP 8.1-based applications"
sudo cp ./deployment/nginx.conf /etc/nginx/sites-available/default

sudo ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

echo "Reloading nginx to apply new configuration"
sudo systemctl reload nginx