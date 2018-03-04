PHP 7 - Phalcon
===============

Image is used for creating OpenClaps microservices. For easy use you can directly pull image from docker hub.

Image Registry : [PHP 7 - Phalcon](https://hub.docker.com/r/openclaps/php7-phalcon/)

---------------------------------------------------

Pre-Request
-----------

Development machine dependencies are listed below:

Download [Docker Engine](https://docs.docker.com/engine/installation/)

Base OS
--------
Linux : Oracle linux
Subversion : 7

Repo :  oraclelinux:7

Softwares
----------
[**Apache** : 2.4.6](https://httpd.apache.org/download.cgi) (Web Server)

[**Phalcon** : 3.0](https://olddocs.phalconphp.com/en/3.0.0/reference/install.html) (Framework)

Refer: RPM distributions (i.e. CentOS) session for more information

[**PHP** : 7.0](http://php.net/releases/7_0_0.php)

Extensions
- php-http 
- php-mcrypt 
- php-cli 
- php-gd  
- php-curl  
- php-mysql  
- php-redis 
- php-zip 
- php-apc 
- php-phalcon3 
- php-mongodb 
- php-mbstring
- php-xml
- php-xmlrpc
- php-process
- php-soap


## Docker Configuration

### Image Configuration

Exposed Ports
- 80
- 443

> Note: if you are running any other application in port 443, you can change line number 8 from 443:443 to [Your port]:443. Make sure you use the same port when loading application in browser

Container Main Tread: 

- Apache (Run in foreground)

### Pull Image

> docker pull openclaps/php7-phalcon 

### Run Image

> docker run -p [your-port]:443 --name openclaps-php7 -v [your-app-path]:/var/www/html/ openclaps/php7-phalcon

### Sample App

Sample folder contain bootstarp code to kickstart new phalcon apps

> - cd to "sample" folder
> - Execute command "docker-compose up"

To stop & remove

> - cd to "sample" folder
> - Execute command "docker-compose down"

Load application in browser : https://localhost

> With custom port use `https://localhost:<your-port>`

## Reference

For more docker specific commands please refer following documents

Dockerfile -  [Offical Document](https://docs.docker.com/engine/reference/builder/)

docker-compose.yml - [Official Document](https://docs.docker.com/compose/compose-file/compose-file-v2/)






