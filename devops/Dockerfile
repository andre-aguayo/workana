FROM nginx:latest as web
COPY ./default.conf /etc/nginx/conf.d/default.conf


FROM php:8.2-fpm as core
RUN docker-php-ext-install mysqli pdo pdo_mysql


FROM mysql/mysql-server:8.0 as mysql
ADD ./tables.sql /docker-entrypoint-initdb.d/
