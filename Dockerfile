FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    redis-tools \
    default-mysql-client \
    dnsutils \
    iputils-ping \
    netcat-traditional


RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd


RUN pecl install redis && docker-php-ext-enable redis


RUN a2enmod rewrite headers


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html


COPY . /var/www/html


COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf


RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

RUN composer install --no-interaction --optimize-autoloader --no-dev


RUN mkdir -p storage/app/public \
    && chmod -R 777 storage/app \
    && chown -R www-data:www-data storage/app \
    && php artisan storage:link


EXPOSE 80

CMD ["apache2-foreground"]
