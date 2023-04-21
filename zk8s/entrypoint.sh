#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

php artisan cache:clear
php artisan config:clear
php artisan route:clear

php-fpm -F --nodaemonize &
/usr/bin/supervisord -c /etc/supervisor/supervisord.conf &
nginx -g "daemon off;"