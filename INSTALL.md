# Installation Instructions
Tested on Ubuntu 20.04 LTS.

1. Clone project repo: `sudo rm -rf /var/www/html && sudo git clone https://github.com/RomanAvery/TripleLMS.git /var/www/html`
    - Make sure scripts are able to be executed: `sudo chmod +x ./deployment/*.sh`
2. Run install script: `cd /var/www/html && sudo ./deployment/vm-install.sh`
3. (Optional) run install script for MySQL: `sudo ./deployment/mysql-install.sh`
    - It will prompt you to create a root password, make sure to keep this safe!
    - ...
4. Configure Laravel Nova authentication: `composer config http-basic.nova.laravel.com ${NOVA_USERNAME} ${NOVA_PASSWORD}`
5. Copy .ENV file and populate it: `cp .env.example .env && sudo nano .env`
6. Install PHP dependencies with Composer: `sudo chown $USER:$USER . -R && composer install --no-dev --no-interaction --prefer-dist --ignore-platform-reqs --optimize-autoloader --apcu-autoloader --ansi --no-scripts`
7. Generate an app key: `php artisan key:generate`
    - Generate routes: `php artisan ziggy:generate`
8. Install Octane and RoadRunner: `php artisan octane:install`
    - Select [0]. RoadRunner, and yes to get the binary.
9. Migrate Laravel (--seed optional): `php artisan migrate:fresh --seed`
10. Run the script to setup nginx: `sudo ./deployment/nginx-install.sh`
    - Edit the server block, adding the required domains: `sudo nano /etc/nginx/sites-enabled/default`
11. Install the Supervisor: `sudo ./deployment/supervisor-install.sh`
12. Install Certbot: `sudo ./deployment/certbot-install.sh`
13: Configure Certbot:
    - `sudo certbot --nginx -d ${DOMAIN} -d www.${DOMAIN}`
14. (Optional) Install Node if the routes change: 
    - As superuser: `sudo apt install nodejs npm -y`
    - As 'octane': `npm i && npm run prod`