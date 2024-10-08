## About the HRMS API

An API (Application Programming Interface) allows different software applications to
communicate with each other using a defined set of rules and protocols. APIs act as
intermediaries that enable the exchange of data or functionality between different systems,
and they can expose specific services or capabilities to external developers. This then allows
them to integrate third-party functionalities into their applications without needing to
understand the internal workings of the system. APIs are fundamental to modern software
development, enabling everything from accessing data to invoking complex operations on
remote servers in a secure and efficient manner.
In the financial services industry, APIs power numerous services from customer-facing
applications and internal workflow tools to regulatory compliance systems.

This HRMS (Human Resource Management System) API serves the purpose of integration of third-party applications
with the existing HRMS. It utilizes features shipped with the Laravel Framework such as user authentication,
and API resource management.

The API consists of 3 main endpoints:
1. Staff Registration
2. Staff Retrieval
3. Staff Update

## Installation (Test Environment)
1. Host machine should have the following tools already installed and fully functional:
* [Docker](https://docs.docker.com/engine/install/ubuntu/#installation-methods)
* [Docker Compose](https://docs.docker.com/desktop/install/linux/ubuntu/)
* [Composer](https://getcomposer.org/download/)
* MySQL v8.0
* PHP v8.2


2. Clone the project directory into a location on the host machine

``git clone https://github.com/AlbertBuluma/HRMS-API .``

3. Create and configure the project env file

``cp .env.example .env``

4. Modify the database variables to much the configurations of your active MYSQL database

``
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=database_port
DB_DATABASE=database_name
DB_USERNAME=database_root_user
DB_PASSWORD=database_password
``

5. Install project package dependencies
``composer install``

6. Run the project database migrations
``php artisan migrate``

7. Seed the database

``php artisan db:seed``

8. Serve the application

``php artisan serve --port=8080``

9. Refer to the following API documentation below on how to configure the endpoint parameters in an HTTP client
   https://documenter.getpostman.com/view/7693053/2sAXxP8s6w


## Deployment (Production Environment)
### 1. Prerequisites
Ensure you have the following in place:

* **Production Server**: A Linux-based server (e.g., DigitalOcean, AWS, etc.) with SSH access.
* **Domain**: A domain name pointing to your server.
* **GitHub** Repository: Your Laravel application hosted in a GitHub repository.
* **Docker and Docker Compose**: Installed on the production server.
* **SSH Keys**: Set up for GitHub access to clone private repositories.

### 2. Step-by-Step Deployment Guide
#### 2.1. Server Setup
##### SSH into your production server:
``ssh user@your-server-ip
``

#### Update your server: Ensure the server is up-to-date before installing Docker.
``sudo apt update && sudo apt upgrade -y
``
#### Install Docker: Follow the Docker installation instructions based on your distribution. On Ubuntu, you can use:
``sudo apt install docker.io
``

#### Install Docker Compose: Docker Compose is essential for managing multi-container Docker applications.
``sudo apt install docker-compose
``

#### Set up a non-root user to manage Docker (optional but recommended):
``sudo usermod -aG docker $USER
``
#### 2.2. Clone the Laravel Application from GitHub
#### 1. Navigate to your project directory:
``cd /var/www
``

#### 2. Clone your Laravel project from GitHub:
``git clone https://github.com/AlbertBuluma/HRMS-Web-app.git`` \
``cd HRMS-Web-app``

#### 2.3 Docker Setup for Laravel
#### 1. Publish the Sail Docker files (if you haven't already): If you are using Laravel Sail, you need to publish the Docker configuration files by running:
``sail artisan sail:publish
``
#### 2. This will generate a docker directory in your project containing Dockerfiles for various environments.
Example docker-compose.yml for production:
```
version: '3'
services:
  laravel.test:
    build:
      context: .
      dockerfile: docker/8.0/Dockerfile
    image: laravel-app
    ports:
      - '80:80'
    environment:
      - APP_ENV=production
      - DB_CONNECTION=mysql
      - DB_HOST=mysql
      - DB_PORT=3306
      - DB_DATABASE=your-database-name
      - DB_USERNAME=your-database-username
      - DB_PASSWORD=your-database-password
    volumes:
      - ./:/var/www/html
    networks:
      - app-network
  mysql:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: root-password
      MYSQL_DATABASE: your-database-name
      MYSQL_USER: your-database-username
      MYSQL_PASSWORD: your-database-password
    volumes:
      - mysql-data:/var/lib/mysql
    networks:
      - app-network
volumes:
  mysql-data:
networks:
  app-network:
```

#### 3. Customize the Dockerfile: If needed, customize the docker/8.0/Dockerfile for additional packages or configurations.
Example customization in the Dockerfile:
```
FROM sail-8.0/app

RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

WORKDIR /var/www/html
```

#### 2.4 Environment Configuration
Copy the .env.example file to .env: \
``cp .env.example .env
``
#### Update the .env file for production:
``nano .env
`` \

Update the following values for your production environment:
```
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=mysql
DB_HOST=mysql
DB_DATABASE=your-database-name
DB_USERNAME=your-database-username
DB_PASSWORD=your-database-password
```
#### 2.5 Build and Start the Containers
1. Build the Docker images: Run the following command to build the images specified in the docker-compose.yml file: \
   ``docker-compose build
   ``
2. Start the containers: Start the Laravel application and other services (like MySQL) using: \
   ``docker-compose up -d
   ``
3. Run database migrations inside the Laravel container: Access the running container and run the migrations:
   ``docker-compose exec laravel.test bash `` \
   ``php artisan migrate --force``

4. Generate the application key: Still inside the container, run:
   ``php artisan key:generate
   ``

