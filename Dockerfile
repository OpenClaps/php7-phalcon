FROM oraclelinux:7-slim
MAINTAINER Vijay, Senthil
# PHP7.1.2 Setup
RUN yum install -y https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm \
    http://rpms.remirepo.net/enterprise/remi-release-7.rpm \
    yum-utils \
    && yum-config-manager --enable remi-php72 \
    && yum install -y mod_ssl \
    httpd \
    php \
    php-http \
    php-mcrypt \
    php-cli \
    php-gd \ 
    php-curl \ 
    php-mysql \ 
    php-pdo \
    php-redis \
    php-zip \
    php-apc \
    php-ldap \
    php-imap \
    php-phalcon3 \
    php-mongodb \
    php-mcrypt \
    && yum clean all \
    && rm -rf /var/cache/yum
#Setup for logs and Apache Virtual host
RUN mkdir -p /web-root/app /web-root/logs /web-root/certs && \
    ln -sf /dev/stdout /web-root/logs/ssl_request_log && \
    ln -sf /dev/stdout /web-root/logs/ssl_error_log && \
    ln -sf /dev/stdout /web-root/logs/ssl_access_log

ADD assets/httpd/ssl.conf /etc/httpd/conf.d/ssl.conf
ADD assets/php/custom.ini /etc/php.d/
ADD assets/certs /web-root/certs

ENV HTTPD_APPLICATION_ENV=local \
    HTTPD_LOG_LEVEL=warn \
    PHP_DISPLAY_ERROR=0 \
    PHP_DISPLAY_ERROR_REPORTING=OFF \
    PHP_TIMEZONE=America/Los_Angeles \
    HTTPD_BASEURL=/ \
    HTTPD_SERVER_ADMIN=localhost@local.com \
    HTTPD_ALLOWED_HEADERS=Content-Type,\ Authorization,\ X-CSRFToken,\ X-AuthToken,\ X-AuthContext,\ X-AuthContextVersion,\ Expires,\ Pragma \
    PHP_DISPLAY_ERROR=0 \
    PHP_DISPLAY_ERROR_REPORTING=OFF \
    PHP_TIMEZONE=America/Los_Angeles \
    HTTPD_HOST_NAME=localhost \
    HTTPD_PORT=443
    
WORKDIR /web-root

EXPOSE 443
ENTRYPOINT [ "httpd","-D","FOREGROUND" ]