# Etapa 1: Build de assets con Node
FROM node:18 as node
WORKDIR /app

COPY package*.json vite.config.js ./
RUN npm install

COPY resources/ resources/
COPY public/ public/
COPY tailwind.config.js postcss.config.js ./
RUN npm run build

# Etapa 2: PHP + Apache
FROM php:8.2-apache

# Dependencias del sistema
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git libpq-dev \
    libicu-dev libjpeg-dev libpng-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo pdo_pgsql zip intl gd

# Habilitar Apache rewrite y apuntar a /public
RUN a2enmod rewrite
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN echo '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

# Workdir de Laravel
WORKDIR /var/www/html

# Copiar código fuente
COPY . .

# Copiar assets compilados desde Node
COPY --from=node /app/public/build /var/www/html/public/build

# Copiar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# Compilar assets Filament si aplica
RUN php artisan filament:assets || true

# Cache de config y rutas
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Permisos correctos
RUN chown -R www-data:www-data storage bootstrap/cache public/build

# Comando de inicio
CMD php artisan migrate --force --seed && apache2-foreground
