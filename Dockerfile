# Etapa 1: Build de assets con Node
FROM node:18 as node
WORKDIR /app

# Copiar package.json y instalar dependencias JS
COPY package*.json ./
RUN npm install

# Copiar todos los archivos y compilar los assets de Vite
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

# Habilitar mod_rewrite de Apache y configurar DocumentRoot a /public
RUN a2enmod rewrite
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Configurar permisos para Laravel
RUN echo '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar código desde el contenedor Node
COPY --from=node /app /var/www/html

# Copiar Composer desde su imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar dependencias PHP (sin dev para producción)
RUN composer install --no-dev --optimize-autoloader

# Compilar assets de Filament (para Filament 3)
RUN php artisan filament:assets

# Asignar permisos correctos para Laravel
RUN chown -R www-data:www-data storage bootstrap/cache public/build

# Comando de inicio
CMD php artisan migrate --force --seed && apache2-foreground
