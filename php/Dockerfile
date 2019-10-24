FROM  php:7.3-apache
RUN apt-get update

RUN apt-get install -y vim less

RUN set -ex apk --no-cache add postgresql-dev libpq-dev
RUN apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql mbstring
COPY src/ /var/www/html
RUN chown www-data:www-data /var/www/html/recursos/* -R