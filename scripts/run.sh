#!/bin/bash

echo "Clear local code directory..."
rm -rf ./.code
echo "Done...!"

echo "Copying code to volume..."
cp -R /var/www/app/. /var/www/html/
echo "Done...!"

echo "Changing chmod to var/cache as 777..."
chmod -R 777 /var/www/html/var/.
echo "Done...!"

echo "Turning off nginx daemon mode..."
echo "daemon off;" >> /etc/nginx/nginx.conf
echo "Done...!"

echo "Starting nginx server.."
service nginx start
