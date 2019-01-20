FROM httpd:2.4

ARG APP_NAME
ARG APP_DOC_ROOT

ENV APP_NAME $APP_NAME
ENV APP_DOC_ROOT $APP_DOC_ROOT

# Vhost config
RUN mkdir -p ${APP_DOC_ROOT} \
    && chmod 0777 ${APP_DOC_ROOT}

# Config apache
COPY ./docker/apache/certs/local/cert.crt /usr/local/apache2/conf/${APP_NAME}_cert.crt
COPY ./docker/apache/certs/local/cert.key /usr/local/apache2/conf/${APP_NAME}_cert.key
COPY ./docker/apache/conf/apache2.conf /usr/local/apache2/conf/httpd.conf
COPY ./docker/apache/conf/httpd-ssl.conf /usr/local/apache2/conf/extra/httpd-ssl.conf

COPY ./docker/apache/conf/httpd-vhosts.conf /usr/local/apache2/conf/extra/httpd-vhosts.conf

COPY . ${APP_DOC_ROOT}
