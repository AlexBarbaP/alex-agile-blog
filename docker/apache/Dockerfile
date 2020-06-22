FROM httpd:2.4

MAINTAINER Alex Agile <alexagile@alexagile.com>

ARG APP_DOC_ROOT
ARG APP_ENV
ARG APP_NAME

ENV APP_DOC_ROOT $APP_DOC_ROOT
ENV APP_ENV $APP_ENV
ENV APP_NAME $APP_NAME

# Vhost config
RUN mkdir -p ${APP_DOC_ROOT} \
    && chmod 0777 ${APP_DOC_ROOT}

# Config apache
COPY ./docker/apache/${APP_ENV}/certs/cert.pem /usr/local/apache2/conf/fullchain.pem
COPY ./docker/apache/${APP_ENV}/certs/key.pem /usr/local/apache2/conf/privkey.pem
COPY ./docker/apache/${APP_ENV}/conf/apache2.conf /usr/local/apache2/conf/httpd.conf
COPY ./docker/apache/${APP_ENV}/conf/httpd-ssl.conf /usr/local/apache2/conf/extra/httpd-ssl.conf

COPY ./docker/apache/${APP_ENV}/conf/httpd-vhosts.conf /usr/local/apache2/conf/extra/httpd-vhosts.conf

COPY . ${APP_DOC_ROOT}
