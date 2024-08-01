FROM php:8.1-apache

WORKDIR /var/www/html

EXPOSE 80

COPY ./websites.conf /etc/apache2/sites-available/websites.conf

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf && \
    a2enmod rewrite && \
    a2dissite 000-default && \
    a2ensite websites && \
    service apache2 restart

RUN apt update && apt upgrade -y \
    git \
    curl \
    mc \
    nodejs \
    npm

RUN docker-php-ext-install bcmath mysqli pdo_mysql \
                            && pecl install redis \
                            && docker-php-ext-enable pdo_mysql redis

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./src /var/www/html

RUN find /var/www/html -type f -exec chmod 644 {} \;  
RUN find /var/www/html -type d -exec chmod 755 {} \;
