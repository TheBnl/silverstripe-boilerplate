FROM brettt89/silverstripe-web:8.1-apache

RUN /bin/sh -c echo 'date.timezone = Europe/Amsterdam' > "$PHP_INI_DIR/conf.d/timezone.ini"

ENV DOCUMENT_ROOT /usr/src/myapp

COPY . $DOCUMENT_ROOT
WORKDIR $DOCUMENT_ROOT

