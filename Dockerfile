FROM brettt89/silverstripe-web:8.1-apache

RUN echo 'date.timezone = Europe/Amsterdam' > "/usr/local/etc/php/conf.d/timezone.ini"

# setup imagic
RUN apt-get update && apt-get install -y \
    imagemagick libmagickwand-dev --no-install-recommends \
    && rm -rf /var/lib/apt/lists/*
RUN pecl install imagick
RUN docker-php-ext-enable imagick

# install mailpit
RUN curl -sL https://raw.githubusercontent.com/axllent/mailpit/develop/install.sh | bash -
RUN echo 'sendmail_path = /usr/local/bin/mailpit sendmail -S mailpit:1025' > "/usr/local/etc/php/conf.d/mailpit.ini"

ENV DOCUMENT_ROOT /var/www/html

COPY . $DOCUMENT_ROOT
WORKDIR $DOCUMENT_ROOT

