FROM php:7.1-cli

RUN apt-get update && apt-get --assume-yes install git wget unzip zip libpq-dev vim phpmd build-essential \
    && rm -rf /var/lib/cache/* && rm -rf /var/lib/apt/lists/*

WORKDIR /tmp
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN wget https://phar.phpunit.de/phpunit.phar && chmod +x phpunit.phar && mv phpunit.phar /usr/local/bin/phpunit

RUN wget https://xdebug.org/files/xdebug-2.5.1.tgz && tar xzf xdebug-2.5.1.tgz \
    && cd xdebug-2.5.1 && phpize \
    && ./configure && make && cp modules/xdebug.so /usr/local/lib/php/extensions/no-debug-non-zts-20160303

RUN cp /usr/share/php5/php.ini-development /usr/local/etc/php/php.ini
ADD 20-xdebug-php-ext.ini /usr/local/etc/php/conf.d

RUN apt-get --assume-yes remove build-essential && apt-get --assume-yes autoremove

WORKDIR /var/www/html


ENTRYPOINT ["phpunit"]
CMD ["-c", "phpunit.xml"]