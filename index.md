# **Installation**
1. Clone project from bitbucket repository git clone git clone https://bitbucket.org/katvet/book_cataloger.git
2. Run `cd book_cataloger`
2. On your terminal run `composer install`, if composer not installed on your machine, go to https://getcomposer.org/ and install
3. Run `cp .env.example .env`
4. Create database and put name, host, user, password and port to `.env` file
5. After that run `php artisan migrate --seed`
6. When migration will be finished run `php artisan passport:install`
7. Run `php artisan key:generate`
8. For running server run `php artisan serve`


Credentials for admin panel

Email: admin@admin.com

Password: pass4now

# API

All URL use POST request

All data must be sent in JSON format

`/api/get_token` return token for OAuth 2.0

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

All action with database recording to `storage/app/logs/current_year/current_month/year-month-day.txt`

