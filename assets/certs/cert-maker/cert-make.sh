#!/bin/sh
cd ../
openssl genrsa -des3 -out server.key 1024
cp server.key server.key.org
openssl rsa -in server.key.org -out server.key
openssl x509 -req -days 365 -in server.csr -signkey server.key -out server.crt
cat server.crt server.key > server.chain.pem