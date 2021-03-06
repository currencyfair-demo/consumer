FROM debian:jessie
MAINTAINER Robert George <robert@poovelil.org>

RUN echo 'deb http://ftp.es.debian.org/debian stable main contrib non-free' >> /etc/apt/sources.list
RUN echo 'deb-src http://ftp.es.debian.org/debian stable main contrib non-free' >> /etc/apt/sources.list

RUN echo 'deb http://ftp.debian.org/debian/ jessie-updates main contrib non-free' >> /etc/apt/sources.list
RUN echo 'deb-src http://ftp.debian.org/debian/ jessie-updates main contrib non-free' >> /etc/apt/sources.list

RUN DEBIAN_FRONTEND=noninteractive apt-get update && apt-get install -y php5-fpm \
			php5 \
			php5-mcrypt \		
			curl 


COPY www-fpm.conf /etc/php5/fpm/pool.d/www.conf

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN composer global require "laravel/installer=~1.1"
RUN composer global require "pda/pheanstalk ~3.0"
RUN composer global require "predis/predis ~1.1@dev"

ENV  PATH ~/.composer/vendor/bin:$PATH
RUN apt-get purge -y curl

EXPOSE 8080
VOLUME ["/var/www/blog"]
COPY consumer-app /var/www/blog
RUN chown -R www-data:www-data /var/www/blog

CMD ["php5-fpm", "--nodaemonize"]
