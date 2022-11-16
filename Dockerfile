FROM brettt89/silverstripe-web:8.1-apache

RUN echo 'date.timezone = Europe/Amsterdam' > "/usr/local/etc/php/conf.d/timezone.ini"

# setup mailhog
RUN apt-get update &&\
    apt-get install --no-install-recommends --assume-yes --quiet ca-certificates curl git &&\
    rm -rf /var/lib/apt/lists/*
RUN curl -Lsf 'https://storage.googleapis.com/golang/go1.8.3.linux-amd64.tar.gz' | tar -C '/usr/local' -xvzf -
ENV PATH /usr/local/go/bin:$PATH
RUN go get github.com/mailhog/mhsendmail
RUN cp /root/go/bin/mhsendmail /usr/bin/mhsendmail
RUN echo 'sendmail_path = /usr/bin/mhsendmail --smtp-addr mailhog:1025' > "/usr/local/etc/php/conf.d/mailhog.ini"

# ENV DOCUMENT_ROOT /usr/src/myapp
ENV DOCUMENT_ROOT /var/www/html

COPY . $DOCUMENT_ROOT
WORKDIR $DOCUMENT_ROOT

