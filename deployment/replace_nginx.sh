#!/bin/bash
echo "Replacing nginx configuration for serving PHP 8.0-based applications"
cp /home/site/wwwroot/nginx.conf /etc/nginx/sites-available/default
 
echo "Reloading nginx to apply new configuration"
service nginx reload