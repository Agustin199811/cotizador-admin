# Etapa 1: Build de assets con Node
FROM node:18 as node
WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . ./
RUN npm run build

# Etapa 2: PHP + Apache
FROM php:8.2-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git libpq-dev \
    libicu-dev libjpeg-dev libpng-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo pdo_pgsql zip intl gd

# Habilitar mod_rewrite y configurar DocumentRoot a /public
RUN a2enmod rewrite
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN echo '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

WORKDIR /var/www/html

COPY --from=node /app /var/www/html

# Copiar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar dependencias PHP sin las de desarrollo
RUN composer install --no-dev --optimize-autoloader

# Compilar assets de Filament si usas Filament 3
RUN php artisan filament:assets || true

# Cache de config y rutas
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Asignar permisos correctos
RUN chown -R www-data:www-data storage bootstrap/cache public/build

# Comando de inicio
CMD php artisan migrate --force --seed && apache2-foreground
