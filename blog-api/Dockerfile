FROM php:8.3-fpm 

RUN apt-get update && apt-get install -y \ 
    build-essential \ 
    libpng-dev \ 
    libjpeg62-turbo-dev \ 
    libfreetype6-dev \ 
    libonig-dev \ 
    libzip-dev \ 
    zip \ 
    unzip \ 
    git \ 
    curl \ 
    supervisor \ 
    mariadb-client 

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer 

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl 
RUN sed -i 's/listen = .*/listen = 9000/' /usr/local/etc/php-fpm.d/www.conf
RUN mkdir -p storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache
RUN pecl install redis \ 
&& rm -rf /tmp/pear \ 
&& docker-php-ext-enable redis

RUN apt-get update && apt-get install -y libicu-dev && docker-php-ext-install intl
    
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - && \ 
    apt-get install -y nodejs && \ 
    apt-get clean && \ 
    rm -rf /var/lib/apt/lists/* 

EXPOSE 8000 

CMD ["php-fpm"]
