FROM php:8.1-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    zip \
    git \
    && docker-php-ext-install pdo pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www

# Copy composer files first to leverage caching
COPY composer.json composer.lock ./

# Install PHP dependencies (composer install)
RUN composer install --no-autoloader --no-scripts

# Copy the rest of the application files
COPY . .

# Run Composer again to autoload
RUN composer dump-autoload --optimize
# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN php artisan key:generate

# Expose port 8000 and set the default command
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
