FROM postgres:9.6-alpine

ADD script.sql /docker-entrypoint-initdb.d/1-script.sql
ADD data-script.sql /docker-entrypoint-initdb.d/2-data-script.sql
