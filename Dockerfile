FROM php:7.4-apache

RUN cd /var/www/html
RUN mkdir einzelzeitfahren
COPY ./ /var/www/html/einzelzeitfahren
# COPY apache/vhosts/ /etc/apache2/sites-available # apache directory for vhost.conf
# COPY apache2/apache2.conf /etc/apache2/

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql

EXPOSE 80
