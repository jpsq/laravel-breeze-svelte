FROM php:8.2-apache

# Habilitar el módulo rewrite de Apache
RUN a2enmod rewrite

WORKDIR /var/www

# Copiar los archivos al contenedor
COPY . .

# Instalar las dependencias necesarias para la extensión zip
RUN apt-get update && apt-get install -y \
    libzip-dev \
    git \
    curl \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Ejecutar Composer para instalar dependencias
RUN composer install --optimize-autoloader

# Generar la clave de la aplicación
RUN php artisan key:generate

# Instalar dependencias de Node.js
RUN npm install
RUN npm run build

# Configuración de Apache
RUN cp -f docker/000-default.conf /etc/apache2/sites-enabled/000-default.conf

# Cambiar permisos para storage y cache
USER root
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache
