FROM nginx:latest 

COPY . /var/www/symfony

RUN rm -f ./etc/nginx/conf.d/default.conf
COPY ./dev/nginx/site.conf /etc/nginx/conf.d/site.conf

RUN chmod a+x /var/www/symfony/dev/nginx/run.sh
CMD /var/www/symfony/dev/nginx/run.sh
