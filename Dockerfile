FROM php:7.4-fpm

# Install apache
RUN apt-get update && apt-get install -y apache2 libapache2-mod-fcgid

# Enable proxy fcgi
RUN a2enmod proxy_fcgi setenvif rewrite

# Install Laravel extension
RUN docker-php-ext-install pdo pdo_mysql

# Copy project
COPY . /var/www/html

# Permission
RUN chown -R www-data:www-data /var/www/html

# Set apache document root
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Connect apache ke php-fpm
RUN echo '<FilesMatch \.php$>\n\
    SetHandler "proxy:fcgi://127.0.0.1:9000"\n\
</FilesMatch>' > /etc/apache2/conf-available/php-fpm.conf

RUN a2enconf php-fpm

EXPOSE 80

CMD service apache2 start && php-fpm
