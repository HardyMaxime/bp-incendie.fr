FROM php:8.3-apache

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        locales \
        apt-utils \
        git \
        libicu-dev \
        g++ \
        libpng-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        libxslt-dev \
        unzip \
        msmtp \
        msmtp-mta \
        telnet \
    && rm -rf /var/lib/apt/lists/* \
    && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen \
    && echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen \
    && locale-gen \
    && echo "AddType text/css .css" >> /etc/apache2/apache2.conf \
    && echo "AddType application/javascript .js" >> /etc/apache2/apache2.conf \
    && curl -sS https://getcomposer.org/installer | php -- \
    && mv composer.phar /usr/local/bin/composer \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get update \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/* \
    && curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony \
    && docker-php-ext-configure intl \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mysqli \
        opcache \
        intl \
        zip \
        calendar \
        dom \
        mbstring \
        gd \
        xsl \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && a2enmod rewrite \
    && a2enmod headers \
    && a2enmod mime

# Configuration de msmtp pour l'envoi d'emails
RUN echo "account default\nhost mailhog\nport 1025\nprotocol smtp\nauth off\ntls off\nfrom support@local.fr\n" > /etc/msmtprc \
    && echo "sendmail_path = /usr/bin/msmtp -t" > /usr/local/etc/php/conf.d/mail.ini

WORKDIR /var/www/

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html