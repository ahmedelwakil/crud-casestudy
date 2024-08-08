#!/bin/bash

composer update
chown -R www-data:www-data /var/www/html/
chmod 777 /var/www/html/storage/ -R
php artisan migrate:install
php artisan migrate
./vendor/bin/phpunit
php artisan db:seed
service supervisor start
supervisorctl start 'laravel-queue-worker:*'
apache2-foreground
