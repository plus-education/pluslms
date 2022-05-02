#!/bin/bash
echo "Replacing nginx configuration for serving PHP 8.1-based applications"
sudo cp ./nginx.conf /etc/nginx/sites-available/default
 
echo "Reloading nginx to apply new configuration"
sudo systemctl reload nginx