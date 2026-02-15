FROM php:7.4-apache

WORKDIR /var/www/html

# Enable rewrite
RUN a2enmod rewrite

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Copy project
COPY . .

# Install Composer dependencies
RUN apt-get update && apt-get install -y git unzip zip \
    && curl -sS https://getcomposer.org/installer | php \
    && php composer.phar install --no-dev --optimize-autoloader \
    && rm -rf /var/lib/apt/lists/*

# Set document root to public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
