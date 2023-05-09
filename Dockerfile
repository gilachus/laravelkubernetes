FROM php:8.0-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    supervisor \
    nginx

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Supervisord conf
RUN mkdir -p /var/log/supervisor
COPY /zk8s/my_supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Nginx
COPY /zk8s/nginx/laravel-app.conf /etc/nginx/sites-available/default

# Set working directory
WORKDIR /var/www

# CMD ["/usr/bin/supervisord"]
# CMD [ "supervisord", "-c", "/etc/supervisor.conf" ]
CMD ["zk8s/entrypoint.sh"]