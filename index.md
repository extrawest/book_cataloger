# **Installation**
1. Clone project from bitbucket repository git clone `https://vitaliy_kaliuzhyn@bitbucket.org/katvet/book_cataloger.git`
2. Run `cd book_cataloger`
2. On your terminal run `composer install`, if composer not installed on your machine, go to https://getcomposer.org/ and install
3. Run `cp .env.example .env`
4. Run `php artisan key:generate`
5. Create database and set name, host, user, password to `.env` file
6. After that run `php artisan migrate --seed`
7. When migration will be finished run `php artisan passport:install`
8. For running server run `php artisan serve`


Credentials for admin panel

Email: admin@admin.com

Password: pass4now

