version: '3'
services:
  app:
    image: nginx
    build: 
      context: .
      dockerfile: dev/nginx/Dockerfile   
    ports: 
      - "8888:80"
    links:
      - php 
    volumes:
      - ./:/var/www/symfony
    depends_on:
      - db

  php:
    image: php:7.1-fpm
    build:
      context: .
      dockerfile: ./dev/php/Dockerfile
    volumes:
      - ./:/var/www/symfony

  db:
    image: mysql:5.7
    volumes:
      - mysql-data:/var/lib/mysql
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: Zaq12345
      MYSQL_DATABASE: rental  
  composer:
    image: composer
    volumes: 
      - ./:/app
    command: ["composer", "install"]  
    
volumes:
  mysql-data:
