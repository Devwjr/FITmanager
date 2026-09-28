#!/bin/sh
set -eu
php artisan migrate --force
php artisan db:seed --class=AdminSeeder --force
php artisan config:cache
exec apache2-foreground
