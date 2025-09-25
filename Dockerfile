# Dockerfile
FROM php:8.2-apache

# Opcional: cambia el document root si tu app está en /var/www/html/CRM
# ARG APACHE_DOCUMENT_ROOT=/var/www/html
# RUN sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/000-default.conf \
#    && sed -ri -e "s!/var/www/!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/apache2.conf

# Extensiones necesarias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilita mod_rewrite si usas .htaccess
RUN a2enmod rewrite

# Copiamos el código (en compose usaremos volume; esto es útil en prod)
# COPY . /var/www/html

# Permisos (opcional, según tu proyecto)
RUN chown -R www-data:www-data /var/www/html

# Exponer puerto (Apache)
EXPOSE 80
