 FROM php:latest
 COPY . /var/www/html
 WORKDIR /var/www/html
 EXPOSE 8085
 CMD ["php","-S","0.0.0.0:8085"]
