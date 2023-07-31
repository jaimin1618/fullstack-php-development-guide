# PHP Full Stack Backend development template

**Steps to configure application:**
* Clone the repo
* Start your XAMPP or WAMP Web server for MYSQL database support 
* Copy .env.example to .env file
* Fill your own database credentials
* run following command: php -S localhost:3000 public/index.php

Final command will run PHP Server and Application (😁 Yes, no need to deploy application folders on Wamp! or Xampp! public endpoints)

<br><br>
**Information about development:**
* Store your all routes inside routes.php file, keep error-handling and 404 in the end. 
* Use header('Content-Type: text/plain') for text/html or building FullStack web application and use header('Content-Type: application/json') for PHP Backend Rest API microservice. 
