How to start

Clone repo:
git clone https://github.com/EugeneGpil/Test2020-09-03.git totallySuperbProject

Go in repo dir:
cd totallySuperbProject

Install composer dependences:
composer install

Create .env file:
cp .env.example .env


Set database connection in .env file.
I am using nano. You can use any text editor:

nano .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=totallySuperbDatabase
DB_USERNAME=mysql_username
DB_PASSWORD=mysql_username_password


Create database for project:
mysql -u mysql_username -p
mysql> CRATE DATABASE totallySuperbDatabase;
mysql> exit

Migrate:
php artisan migrate

Seed:
php artisan db:seed

Serve:
php artisan serve


Done! Everything ready.

Important note:
all requests should be with header X-Requested-With: XMLHttpRequest
