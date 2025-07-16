FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . /var/www/html

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/html

# Create the .env file directly with correct database settings (AFTER all copies)
RUN echo 'APP_NAME="Mini CRM"' > .env && \
    echo 'APP_ENV=local' >> .env && \
    echo 'APP_KEY=' >> .env && \
    echo 'APP_DEBUG=true' >> .env && \
    echo 'APP_URL=http://localhost:8000' >> .env && \
    echo '' >> .env && \
    echo 'DB_CONNECTION=mysql' >> .env && \
    echo 'DB_HOST=mysql' >> .env && \
    echo 'DB_PORT=3306' >> .env && \
    echo 'DB_DATABASE=mini_crm' >> .env && \
    echo 'DB_USERNAME=mini_crm_user' >> .env && \
    echo 'DB_PASSWORD=mini_crm_password' >> .env && \
    echo '' >> .env && \
    echo 'SESSION_DRIVER=database' >> .env && \
    echo 'CACHE_STORE=database' >> .env && \
    echo 'QUEUE_CONNECTION=database' >> .env

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Generate application key
RUN php artisan key:generate

# Expose port 8000 and start php-fpm server
EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
