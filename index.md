# **Installation**
1. Clone project from bitbucket repository in you installation directory
2. On your terminal run`composer install`, if you composer not installed on you machine go to https://getcomposer.org/ and install
3. Run `cp .env.example .env`
4. Run `php artisan key:generate`
5. Create database and set name, host, user, password to `.env` file
6. After that run `php artisan migrate --seed`
7. When migration will be finished run `php artisan passport:install`