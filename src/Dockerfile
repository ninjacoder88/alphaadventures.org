#use the php-apache image
FROM php:7.4-apache

#install pdo
RUN docker-php-ext-install pdo pdo_mysql

COPY site/ /var/www/html/site
COPY api/ /var/www/html/api
COPY index.php /var/www/html/