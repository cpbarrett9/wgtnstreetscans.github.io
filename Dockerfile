# Use official PHP + Apache image
FROM php:8.2-apache

# Copy your site into the Apache document root
COPY . /var/www/html/

# Enable Apache mod_rewrite (optional but usually needed)
RUN a2enmod rewrite
