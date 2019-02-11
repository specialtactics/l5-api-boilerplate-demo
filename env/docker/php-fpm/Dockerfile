ARG PHP_VERSION=${PHP_VERSION}

FROM php:${PHP_VERSION}-fpm

# Install packages for required extensions
RUN apt-get update \
  && apt-get install -y --no-install-recommends \
    libz-dev \
    libpq-dev \
    libssl-dev \
    libmcrypt-dev \
    libicu-dev \
    libxml2-dev \
    curl \
  && rm -rf /var/lib/apt/lists/*

# Install Laravel required extensions
RUN docker-php-ext-install json
RUN docker-php-ext-install json
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install xml
RUN docker-php-ext-install ctype
RUN docker-php-ext-install tokenizer
RUN docker-php-ext-install pdo_pgsql
RUN docker-php-ext-install opcache
RUN docker-php-ext-install zip
RUN docker-php-ext-configure intl && docker-php-ext-install intl
RUN docker-php-ext-install bcmath

###########################################################################
# xDebug:
###########################################################################

ARG PHP_XDEBUG_ENABLE=false
RUN if [ ${PHP_XDEBUG_ENABLE} = true ]; then \
    # Install the xdebug extension
    pecl install xdebug && \
    docker-php-ext-enable xdebug \
;fi

# Copy xdebug configuration for remote debugging
COPY ./xdebug.ini /usr/local/etc/php/conf.d/

ARG PHP_XDEBUG_REMOTE_CONNECT_BACK=false
RUN if [ ${PHP_XDEBUG_REMOTE_CONNECT_BACK} = true ]; then \
    echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/conf.d/xdebug.ini \
;fi

###########################################################################
# Check PHP version:
###########################################################################

ARG PHP_VERSION=${PHP_VERSION}

RUN php -v | head -n 1 | grep -q "PHP ${PHP_VERSION}."

###########################################################################
# Copy PHP configuration files
###########################################################################

COPY ./php.ini /usr/local/etc/php/
COPY ./opcache.ini /usr/local/etc/php/conf.d/
COPY ./laravel.ini /usr/local/etc/php/conf.d/
COPY ./xlaravel.pool.conf /usr/local/etc/php-fpm.d/

USER root

###########################################################################
# Clean up
###########################################################################

RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    rm /var/log/lastlog /var/log/faillog

RUN usermod -u 1000 www-data

WORKDIR /var/www
