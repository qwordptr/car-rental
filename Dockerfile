FROM nginx:latest

RUN rm -f ./etc/nginx/conf.d/default.conf
COPY ./nginx/site.conf /etc/nginx/conf.d/site.conf

RUN rm -rf /var/www/html
COPY . /var/www/app

RUN chmod a+x /var/www/app/scripts/run.sh
CMD /var/www/app/scripts/run.sh
