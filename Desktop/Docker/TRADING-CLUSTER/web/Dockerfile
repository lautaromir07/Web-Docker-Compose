FROM php:8.2-apache

# Install PDO MySQL extension and curl for healthcheck
RUN apt-get update && apt-get install -y libcurl4-openssl-dev curl && \
    docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite for cleaner URLs if needed
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html
