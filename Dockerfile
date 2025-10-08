FROM php:8.2-apache-bullseye

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo pdo_mysql gd zip opcache \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Configurar Apache para apuntar al public/ de Laravel
RUN sed -i 's|/var/www/html|/var/www/html/laravel/public|g' /etc/apache2/sites-available/000-default.conf \
    && echo "<Directory /var/www/html/laravel/public>\n    AllowOverride All\n    Require all granted\n</Directory>" >> /etc/apache2/apache2.conf

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 👉 Aquí está la corrección clave
WORKDIR /var/www/html/laravel

EXPOSE 80

CMD ["apache2-foreground"]
