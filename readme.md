# Roohub Test Project

## Requirements

 - PHP 7.2
 - PHP 5.6
 - MySQL 5.7 (Any)
 - PHP Dom (Specific to PHP 7.2)
 - Composer
 - mcrypt for PHP 7.2

 ## Installation

 - Clone the Project
 - git clone `git@github.com:michaelpanco/roohub_backend.git`
 - go to the folder, and run `composer install`
 - copy .env.sample content and create a .env file
 - change all the database params corresponds to your database credentials from your .env file

 ## Database Data

Please run the commands below to put up the database table and seed all the sample data for testing

- `php artisan migrate`
- `php artisan db:seed`