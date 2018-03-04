FROM oraclelinux:7-slim

# PHP7 Setup
RUN yum install -y https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm \
    http://rpms.remirepo.net/enterprise/remi-release-7.rpm \
    yum-utils \
    && yum-config-manager --enable remi-php70 \
    && yum install -y mod_ssl \
    httpd \
    php \
    php-http \
    php-mcrypt \
    php-cli \
    php-gd \ 
    php-curl \ 
    php-mysql \ 
    php-redis \
    php-zip \
    php-apc \
    php-phalcon3 \
    php-mongodb \
    php5-mcrypt \
    && yum clean all \
    && rm -rf /var/cache/yum
EXPOSE 443 80
ENTRYPOINT [ "httpd","-D","FOREGROUND" ]