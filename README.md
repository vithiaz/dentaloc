<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Dentaloc Installation Guide
Program Dependencies:
- php version 8.1
- NPM version 9.5
- Composer version 2.5

Configuration Guide
- Copy and rename file .env.example to .env
- in .env file, Set DB_DATABASE, DB_USERNAME, and DB_PASSWORD based on your local database credentials

Next step, open project files in terminal then run :
- $ composer update
- $ php artisan key:generate
- $ php artisan storage:link
- $ php artisan migrate
- $ php artisan db:seed --class=DatabaseSeeder
- note that the admin default credentials is generated in seeder file located in database/seeders/DatabaseSeeder.php

To run the app, make sure the Database Server is running then run:
- $ php artisan serve