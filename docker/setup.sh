#!/usr/bin/env bash

## VARIABLES
SCRIPTDIR=$(dirname "$0")
BASEDIR=$(realpath "$SCRIPTDIR/../")
APPNAME="php_api_test"
DBNAME="${APPNAME}_db"

## SETUP
docker run --name "$DBNAME" -e MYSQL_ROOT_PASSWORD=root -e MYSQL_DATABASE=db -d mariadb && \
docker run \
    --name "$APPNAME" \
    --link "$DBNAME" \
    -p 80:80 \
    -v "$BASEDIR/docker/nginx/vhost":/etc/nginx/sites-available/default \
    -v "$BASEDIR/app":/var/www \
    -d -t flyingkrai/php56-nginx && \
docker exec "$APPNAME" sh -c "service nginx start && service php5.6-fpm start" && \
docker exec "$APPNAME" sh -c "cd /var/www && composer install" && \
docker exec "$APPNAME" sh -c "cd /var/www && php artisan migrate:install && php artisan migrate"

