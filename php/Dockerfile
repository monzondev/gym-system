FROM  php:7.3-apache

# Actualizar APT
RUN apt-get update

# Instalar Driver de Postgresql par PHP
RUN apt-get install -y vim less nano
RUN set -ex apk --no-cache add postgresql-dev libpq-dev
RUN apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql mbstring
COPY src/ /var/www/html
RUN chown www-data:www-data /var/www/html/recursos/* -R

# Agregando phpunit con PHAR
RUN apt-get install -y wget
RUN wget -O /opt/phpunit https://phar.phpunit.de/phpunit-8.phar
RUN chown 1000:1000 /opt/phpunit
RUN chmod +x /opt/phpunit
RUN echo "alias phpunit='/opt/phpunit'" >> /root/.bashrc

# Cron se ejecutara cada minuto para actualizar los miembros
RUN apt-get install -y cron
RUN echo "* * * * * /usr/local/bin/php /var/www/html/utils/cron/updateMiembros.php >> /var/www/html/utils/cron/logs" | crontab -
RUN service cron start