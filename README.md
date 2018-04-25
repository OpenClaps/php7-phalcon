# PHP 7 - Phalcon


Image is used for creating OpenClaps micro services. For easy use you can directly pull image from docker hub.

Image Registry : [PHP 7 - Phalcon](https://hub.docker.com/r/openclaps/php7-phalcon/)


# Pre-Request


Development machine dependencies are listed below:

Download [Docker Engine](https://docs.docker.com/engine/installation/)

# Base OS

Linux : Oracle linux
Subversion : 7-slim

Repo :  oraclelinux:7-slim

### Packages

[**Apache** : 2.4.6](https://httpd.apache.org/download.cgi) (Web Server)

[**Phalcon** : 3.0](https://olddocs.phalconphp.com/en/3.0.0/reference/install.html) (Framework)

Refer: RPM distributions (i.e. CentOS) session for more information

[**PHP** : 7.2.2](http://php.net/releases/7_2_3.php)

Extensions
- php-http 
- php-mcrypt 
- php-cli 
- php-gd 
- php-curl 
- php-mysql 
- php-pdo 
- php-redis 
- php-zip 
- php-apc 
- php-ldap 
- php-imap 
- php-phalcon3 
- php-mongodb 
- php-oci8-12c 
- php-mcrypt 


## Environment Variables
#### Apache

##### Log Levels

> HTTPD_LOG_LEVEL warn [Default]
> ##### Supported Options:
> - emerg
> - alert
> - crit
> - error
> - warn
> - notice
> - info
> - debug
> - trace1
> - trace2
> - trace3
> - trace4
> - trace5
> - trace6
> - trace7
> - trace8

##### Other ENV variables
> - HTTPD_BASEURL /  [Support for application base url]
> - HTTPD_SERVER_ADMIN localhost@localhost.com [Server admin email]
> - HTTPD_HOST_NAME localhost [Host server name]

#### PHP

##### Log Levels
> PHP_DISPLAY_ERROR_REPORTING OFF [Default]
> ##### Supported Options:
> - E_ALL All
> - E_ERROR
> - E_WARNING
> - E_PARSE
> - E_DEPRECATED
> - E_NOTICE
> - E_CORE_ERROR
> - E_CORE_WARNING
> - E_COMPILE_ERROR
> - E_COMPILE_WARNING
> - E_USER_ERROR
> - E_USER_WARNING
> - E_USER_NOTICE

##### Other ENV variables
> - PHP_DISPLAY_ERROR 0 [To display php error]
> - PHP_TIMEZONE America/Los_Angeles [PHP timezone]

## Docker Configuration

Working Dir : /web-root

All application dependecies are mounted under /ngs folder as
- /web-root/app
- /web-root/certs
- /web-root/logs

Log Channel: All following logs are channeled to STDOUT
- /web-root/logs/ssl_request_log
- /web-root/logs/ssl_error_log
- /web-root/logs/ssl_access_log

### Image Configuration

Exposed Ports
- 443

> Note: if you are running any other application in port 443, Change container port to another free port from host machine

Container Main Tread: 

- Apache (Run in foreground)

### Pull Image

> docker pull openclaps/php7-phalcon 

### Run Image

> docker run -p [your-port]:443 --name openclaps-php7 -v [your-app-path]:/web-root/app openclaps/php7-phalcon

### Sample App

Sample folder contain bootstarp code to kickstart new phalcon apps

> - cd to "sample" folder
> - Execute command "docker-compose up"

To stop & remove

> - cd to "sample" folder
> - Execute command "docker-compose down"

Load application in browser : https://localhost/api/robots

> With custom port use `https://localhost:<your-port>`

## Custom Settings

### Docker Network

- For connecting your application container to running external container in your host machine. Updated docker-compose.yml with following code.

Example : If we need "webapp","redis" and "mongo" container to run in default network. Make following change in docker-compose.yml

- Update in webapp service
```
    webapp:
    ....
    ..
    network_mode: bridge
    links:
      - mongo
      - redis
    ..
    .....
```

- Update in mongo service
```
  mongo:
    ....
    ...
    volumes:
      - ./app/data:/data/db
    network_mode: bridge
    

```

- Update in redis service
```
  redis:
    ....
    ...
    container_name: redis
    network_mode: bridge

```

"links" are deprecated feature from docker-compose please avoid using it.



#### Recommendation
> Keep isolated custom network created by "docker-compose up" for each application.For data persistence map your data volume from your container images to "data" folder in application.Exclude "data" folder in .gitignore


## Reference

For more docker specific commands please refer following documents

Dockerfile -  [Offical Document](https://docs.docker.com/engine/reference/builder/)

docker-compose.yml - [Official Document](https://docs.docker.com/compose/compose-file/compose-file-v2/)






