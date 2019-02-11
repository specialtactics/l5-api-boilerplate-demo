FROM nginx:alpine

COPY nginx.conf /etc/nginx/
COPY sites/laravel.conf /etc/nginx/conf.d/
COPY upstream.conf /etc/nginx/conf.d/
RUN rm -f /etc/nginx/conf.d/default.conf

RUN adduser -D -H -u 1000 -s /bin/sh www-data

EXPOSE 80 443
