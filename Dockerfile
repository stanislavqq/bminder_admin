FROM php:8.2-fpm

WORKDIR /app

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

#RUN apt-get update && apt-get install -y \
#    wget;

RUN apt-get update && apt-get install bash \
    && docker-php-ext-install pdo_mysql \
    && chmod -R 777 var


#RUN docker-php-ext-enable xdebug;

#RUN set -eux; \
#	install-php-extensions \
#		@composer \
#		apcu \
#		intl \
#		opcache \
#		zip \
#	;