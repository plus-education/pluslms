#!/bin/bash

WWWUSER=1001
WWWGROUP=1000

sudo apt update && sudo apt upgrade -y
sudo apt install software-properties-common apt-transport-https -y
sudo apt install -y software-properties-common && sudo add-apt-repository ppa:ondrej/php -y
sudo apt install -y software-properties-common && sudo add-apt-repository ppa:openswoole/ppa -y
sudo apt update && sudo apt upgrade -y

# Install PHP 8.1
sudo apt install nginx php8.1 -y

# Disable apache2, enable nginx
sudo systemctl stop apache2 && sudo systemctl disable apache2
sudo systemctl start nginx

# Install pecl and other php modules
sudo apt install php-pear
sudo apt-get update && apt-get upgrade -yqq
sudo pecl -q channel-update pecl.php.net
sudo apt-get install -yqq --no-install-recommends --show-progress \
          apt-utils \
          gnupg \
          gosu \
          git \
          curl \
          wget \
          libcurl4-openssl-dev \
          ca-certificates \
          supervisor \
          libmemcached-dev \
          libz-dev \
          libbrotli-dev \
          libpq-dev \
          libjpeg-dev \
          libpng-dev \
          libfreetype6-dev \
          libssl-dev \
          libwebp-dev \
          libmcrypt-dev \
          libonig-dev \
          libzip-dev zip unzip \
          libargon2-1 \
          libidn2-0 \
          libpcre2-8-0 \
          libpcre3 \
          libxml2 \
          libzstd1 \
          procps \
          libc-ares-dev

sudo apt install -y php8.1-openswoole
sudo bash -c "cat > /etc/php/8.1/mods-available/openswoole.ini << EOF
; Configuration for Open Swoole
; priority=30
extension=openswoole
EOF"
sudo phpenmod -s cli openswoole

sudo apt-get install -y php8.1-zip php8.1-mbstring php8.1-gd php8.1-opcache php8.1-redis php8.1-intl php8.1-xml php8.1-memcached 

#
# COMPOSER INSTALL
#

EXPECTED_CHECKSUM="$(php -r 'copy("https://composer.github.io/installer.sig", "php://stdout");')"
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
ACTUAL_CHECKSUM="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"

if [ "$EXPECTED_CHECKSUM" != "$ACTUAL_CHECKSUM" ]
then
    >&2 echo 'ERROR: Invalid installer checksum'
    rm composer-setup.php
    exit 1
fi

php composer-setup.php --quiet
RESULT=$?
rm composer-setup.php

sudo mv composer.phar /usr/local/bin/composer

#
# END COMPOSER INSTALL
#