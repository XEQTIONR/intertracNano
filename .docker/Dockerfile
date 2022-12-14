FROM php:7.4.1-apache

USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        zip \
        curl \
        unzip \

    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-source delete

COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

#install NodeJS
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash \
    && apt-get  -y install nodejs



RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY composer.json composer.json

RUN composer self-update --2

RUN php -d memory_limit=-1 \
&& composer install  --prefer-dist  --no-scripts --no-autoloader

# App must be copied after composer install -- I dont know why
COPY . .

RUN npm install \
    && npm run dev

#RUN composer dump-autoload \

RUN chown -R www-data:www-data /var/www/html/storage \
   && a2enmod rewrite \
   # Optional
   && service apache2 restart

COPY .env.docker ./.env

RUN chown www-data:www-data .env

RUN php artisan key:generate
