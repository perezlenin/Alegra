FROM php:7.3-cli-stretch
COPY ./ /usr/src/myapp
WORKDIR /usr/src/myapp
COPY start_workerman.sh /
RUN chmod +x /start_workerman.sh
RUN  uname -a && apt update
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
RUN docker-php-ext-install sockets pcntl posix
RUN  apt-get install libevent-dev libssl-dev -y && pecl install event
RUN  echo extension=event.so > /usr/local/etc/php/conf.d/30-event.ini
EXPOSE 2345
ENTRYPOINT [ "/start_workerman.sh" ]