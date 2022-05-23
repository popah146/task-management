Laravel Task Management Application
Basic Task Management Appliction using Laravel and Bootstrap Framework. Here, User can register and login and can manage his projects and every task inside a project.

Pre-Requisites

Composer Install
Xampp (PHP -> 8.0.2)
Node Js
Bootsrap ui
Laravel V-9

Clone the project repository by running the command below if you use SSH

git clone git@github.com:codeaamirkalimi/Task-Management-System-Laravel.git
If you use https, use this instead

git clone https://github.com/codeaamirkalimi/Task-Management-System-Laravel.git
After cloning, run:

composer install
npm install
Duplicate .env.example and rename it .env

Then run:

php artisan key:generate
Prerequisites
Be sure to fill in your database details in your .env file before running the migrations:

php artisan migrate
And finally, start the application:

php artisan serve
and visit http://localhost:8000 to see the application in action.