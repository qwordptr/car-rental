#!/bin/bash

chmod -R 777 /var/www/html/var

echo "Turning off nginx daemon mode..."
grep -q 'daemon off;' /etc/nginx/nginx.conf || echo 'daemon off;' >> /etc/nginx/nginx.conf
echo "Done...!"


service nginx start
<<<<<<< HEAD

=======
>>>>>>> bd6af57180ec001b546a5e0ac5d5c7ef9fb97626
