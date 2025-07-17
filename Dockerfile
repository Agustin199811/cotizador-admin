FROM node:18 as node
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY --from=node /app /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data storage bootstrap/cache public/build

EXPOSE 80
