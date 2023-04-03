FROM nginx:latest as web

COPY ./default.conf /etc/nginx/conf.d/default.conf


FROM php:8-fpm as core

RUN docker-php-ext-install mysqli pdo pdo_mysql