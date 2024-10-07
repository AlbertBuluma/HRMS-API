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

## Installation
1. Host machine should have the following tools already installed and fully functional:
* [Docker](https://docs.docker.com/engine/install/ubuntu/#installation-methods)
* [Docker Compose](https://docs.docker.com/desktop/install/linux/ubuntu/)
* [Composer](https://getcomposer.org/download/)
* MySQL v8.0
* PHP v8.2


2. Clone the project directory into a location on the host machine

``git clone https://....``

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


