FROM php:8.2-apache


RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd

RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .


RUN composer install --no-dev --optimize-autoloader


RUN npm install
RUN npm run build

RUN chown -R www-data:www-data /var/www/html/storage \
    /var/www/html/bootstrap/cache \
    /var/www/html/database \
    /var/www/html/public

EXPOSE 80

CMD php artisan config:clear && php artisan view:clear && php artisan storage:link && php artisan migrate --force && apache2-foreground