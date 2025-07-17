FROM node:18 as node
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . ./
RUN npm run build

FROM php:8.2-apache

# Instala dependencias necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git libpq-dev \
    libicu-dev libjpeg-dev libpng-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo pdo_pgsql zip intl gd

RUN a2enmod rewrite

WORKDIR /var/www/html

# Copiar archivos desde build Node
COPY --from=node /app /var/www/html

# Copiar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar dependencias PHP optimizadas
RUN composer install --no-dev --optimize-autoloader

# Asignar permisos correctos
RUN chown -R www-data:www-data storage bootstrap/cache public/build

EXPOSE 80
