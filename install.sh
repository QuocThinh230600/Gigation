#!/bin/bash

echo "Welcome to Sam CMS"
echo "Install CMS"
composer install
echo -n"Enter Database Name >"
read database_name
echo -n"Enter Database Username >"
read database_username
echo -n"Enter Database Password >"
read database_password
sed -i -e "s/DB_DATABASE=/DB_DATABASE=$database_name/g" .env.example
sed -i -e "s/DB_USERNAME=/DB_USERNAME=$database_username/g" .env.example
sed -i -e "s/DB_PASSWORD=/DB_PASSWORD=$database_password/g" .env.example
cp .env.example .env
rm .env.example-e
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan passport:install
php artisan ckfinder:download
php artisan vietnamzone:download
echo "Done"