# Projet BileMo
---

## Codacy Badge

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/2f3045ccd80c4ab48f4771405fe2a28f)](https://www.codacy.com/gh/bernikw/Projet-7/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=bernikw/Projet-7&amp;utm_campaign=Badge_Grade)

## Getting started

### BUild with
   - Symfony 6.1
   - PHP version 8.1.6
   - Version du serveur 10.4.24
   - Composer 2.3.10

1. Git clone the project
    - https://github.com/bernikw/Projet-7.git

2. Install libraries with https://getcomposer.org/
    - composer install

3. Create database
    - Configure database in .env file
    - Create database: symfony console doctrine:database:create
    - Create database structure: symfony console make:migration
    - Insert fixtures data: symfony console doctrine:fixtures:load

4. Login reseller 

   1)   - email: jacobi.anais@keebler.com  
        - password: tada

   2)   - email: howell.jade@gmail.com
        - password: tada

5. Launch the site
    - symfony serve
