FROM php:8.2-apache

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Habilita mod_rewrite de Apache
RUN a2enmod rewrite

# Copia el proyecto al contenedor
COPY . /var/www/html

# Cambia el DocumentRoot para que apunte a la carpeta public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Permite Override para que Laravel use .htaccess (mod_rewrite)
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Da permisos correctos (importante para storage y cache)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Ejecuta Composer para instalar dependencias
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Expone el puerto 80
EXPOSE 80

# Comando para iniciar Apache en primer plano
CMD ["apache2-foreground"]
