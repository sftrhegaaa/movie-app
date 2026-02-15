FROM php:7.4-apache

# Paksa disable semua MPM dulu
RUN a2dismod mpm_event || true
RUN a2dismod mpm_worker || true

# Aktifkan prefork (yang benar untuk PHP)
RUN a2enmod mpm_prefork

# Install extension Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Enable rewrite
RUN a2enmod rewrite

# Copy project
COPY . /var/www/html

# Permission
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Set document root ke public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf
