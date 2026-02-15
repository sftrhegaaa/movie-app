FROM php:7.4-apache

# Install extensions yang dibutuhkan Laravel 5
RUN docker-php-ext-install pdo pdo_mysql

# Aktifkan mod_rewrite
RUN a2enmod rewrite

# HAPUS ini kalau ada:
# RUN a2dismod mpm_event
# RUN a2enmod mpm_prefork
# (JANGAN set MPM manual)

# Copy project
COPY . /var/www/html

# Set permission
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Set document root ke public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf
