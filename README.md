# Book Cataloger

## About Book Cataloger
Basic admin interface and RestFulAPI for managing a book catalog. 

## Installation

### Development Environment
* install vendor libs: `composer install`
* Run `cp .env.example .env` end edit .env file manually
* Create database and put name, host, user, password and port to `.env` file
* run migrations with setting default data: `php artisan migrate --seed`
* install laravel passport for OAuth2.0 authentication `php artisan passport:install`
* generate key `php artisan key:generate`
* run internal server: `php artisan serve`

### Production Environment
* install vendor libs: `composer install`
* Run `cp .env.example .env` end edit .env file manually
* Create database and put name, host, user, password and port to `.env` file
* run migrations: `php artisan migrate --seed`
* run setting default admin data: `php artisan db:seed --class=ProductionUsersTableSeeder`
* install laravel passport for OAuth2.0 authentication `php artisan passport:install`
* generate key `php artisan key:generate`
* Login and change administrator e-mail and password


Credentials for admin panel

Email: admin@admin.com

Password: pass4now!

All action with database recording to `storage/app/logs/current_year/current_month/year-month-day.txt`

## Environments
* Debug settings:
  * APP_DEBUG - (true|false)
  * APP_ENV - system environment (dev|prod|local)
* Change site root
  * APP_URL - change to you own site url
* Application name:
    * APP_NAME - change name of application
* Database settings
  * DB_CONNECTION - type of database (sqlite|mysql|pgsql|sqlsrv)
  * DB_HOST - database url
  * DB_PORT - database connection port (mysql: 3306|pgsql: 5432|sqlsrv:1433)
  * DB_DATABASE - name of your database
  * DB_USERNAME - database username 
  * DB_PASSWORD - database user password
* Mail settings
    * MAIL_DRIVER - set you mail driver (smtp|sendmail|mailgun|mandrill|ses|sparkpost|postmark|log|array)
    * MAIL_HOST - mail server url
    * MAIL_PORT - mail server port
    * MAIL_USERNAME - mail username
    * MAIL_PASSWORD - mail user password
    * MAIL_ENCRYPTION - specify the encryption protocol
 



## API

All URL use POST request

All data must be sent in JSON format

`/api/get_token` return token for OAuth 2.0 Required fields are `email, password`

`/api/authors` return all authors

`/api/authors/create` create author. Required fields are `name, email, password, password_confirmation`

`/api/authors/{author}/edit` edit author, where {author} = author id. Required fields are `name`

`/api/authors/{author}/delete` delete author, where {author} = author id

`/api//publishers` return all publisher

`/api/publishers/create` create publisher. Required fields are `title, url`

`/api/publishers/{publisher}/edit` edit publisher, where {publisher} = publisher id. Required fields are `title, url`

`/api/publishers/{publisher}/delete` delete publisher, where {publisher} = publisher id.

`/api/books` return all books.

`/api/books/create` create book. Required fields are `title, publisher = publisher id, author = author id, isbn, count_of_pages`

`/api/books/{book}/edit` edit book, where {book} = book id. Required fields are `title, isbn, count_of_pages, author, publisher`

`/api/books/{book}/delete` delete book, where {book} = book id

