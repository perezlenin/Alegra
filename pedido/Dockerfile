FROM php:7.4-apache
WORKDIR /var/www/html/
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
COPY . .
EXPOSE 80
RUN composer install
RUN php artisan migrate
CMD ["php","-S","0.0.0.0:80","-t","public"]