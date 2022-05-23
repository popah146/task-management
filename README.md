<h1>Task management </h1>
<hr>
Laravel Task Management is basic Task Management Appliction using Laravel and Bootstrap Framework. Here, User can register and login and can manage his projects and every task inside the project. Nothing fancy on design, will work on it later.

<h3>Pre-Requisites</h3>
<hr>
Composer Install,
Xampp (PHP -> 8.0.2),
Node Js,
Bootstrap ui,
Laravel Version 9

<h3>Setup</h3>
<hr>
#Clone the project repository by running the command below if you use SSH

git clone git@github.com:popah146/task-management.git

#If you use https, use this instead

git clone https://github.com/popah146/task-management.git

After cloning, run:
composer install
npm install
Duplicate .env.example and rename it .env
Then run:
php artisan key:generate
##Note

Be sure to fill in your database details in your .env file before running the migrations:

php artisan migrate
And finally, start the application:
php artisan serve
and visit http://localhost:8000 to see the application in action.

<h3>TASK MANANGEMENT Features.</h3>
<hr>
Users can log in to ceate a project
Projects can be edited or deleted
Projects contain tasks 
User can view a particular task(s) associated a project.
Tasks can be managed (Add , view, edit, delete).
all Tasks can be ordered by drag and drop. 

<h3>#FEATURES TO WORK ON.</h3>
<hr>
Project status
Task status 
distinct task orderfor specific project.
Over all design.
<hr>
I hope it helps. 
