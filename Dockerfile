FROM php:7.4

# Install apache manually
RUN apt-get update && apt-get install -y \
    apache2 \
    git \
    unzip \
    zip \
    libapache2-mod-php \
    && rm -rf /var/lib/apt/lists/*

# Enable prefork ONLY
RUN a2dismod mpm_event || true
RUN a2dismod mpm_worker || true
RUN a2enmod mpm_prefork
RUN a2enmod rewrite

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

COPY . .

# Install composer
RUN curl -sS https://getcomposer.org/installer | php \
    && php composer.phar install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Change Apache document root to public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["apachectl", "-D", "FOREGROUND"]
