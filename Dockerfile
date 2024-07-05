FROM php:7.4-apache

# Arguments defined in docker-compose.yml
#ARG pva
#ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    snmp snmpd \
    nano \
    systemctl \
    libsnmp-dev \
    iputils-ping -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    -y

# Needs to Laravel mode rewrite
RUN a2enmod rewrite

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install zip mysqli pdo_mysql mbstring exif pcntl bcmath gd
RUN docker-php-ext-enable mysqli
RUN docker-php-ext-install snmp

# Change way into apacheConfig   from   /var/www/html   to   /var/www/public
RUN sed -i 's/var\/www\/html/var\/www\/public/' /etc/apache2/sites-enabled/000-default.conf

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
#RUN useradd -G www-data,root -u $uid -d /home/pva pva
#RUN mkdir -p /home/pva/.composer && \
    #chown -R pva:pva /home/pva

# Set working directory
WORKDIR /var/www