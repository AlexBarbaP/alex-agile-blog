FROM httpd:2.4

MAINTAINER Alex Agile <alexagile@alexagile.com>

ARG APP_DOC_ROOT
ARG APP_ENV
ARG APP_NAME
ARG CERT_PATH
ARG CERT_KEY_PATH

ENV APP_NAME $APP_NAME
ENV APP_DOC_ROOT $APP_DOC_ROOT
ENV APP_NAME $APP_NAME
ENV CERT_PATH $CERT_PATH
ENV CERT_KEY_PATH $CERT_KEY_PATH

# Vhost config
RUN mkdir -p ${APP_DOC_ROOT} \
    && chmod 0777 ${APP_DOC_ROOT}

# Config apache
COPY ${CERT_PATH} /usr/local/apache2/conf/fullchain.pem
COPY ${CERT_KEY_PATH} /usr/local/apache2/conf/privkey.pem
COPY ./docker/apache/${APP_ENV}/conf/apache2.conf /usr/local/apache2/conf/httpd.conf
COPY ./docker/apache/${APP_ENV}/conf/httpd-ssl.conf /usr/local/apache2/conf/extra/httpd-ssl.conf

COPY ./docker/apache/${APP_ENV}/conf/httpd-vhosts.conf /usr/local/apache2/conf/extra/httpd-vhosts.conf

COPY . ${APP_DOC_ROOT}
