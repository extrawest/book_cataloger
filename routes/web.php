<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->home();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/admin/books', 'BookController@index')->name('all_books');
Route::get('/admin/books/create', 'BookController@create')->name('create_book');
Route::post('/admin/books/create', 'BookController@store')->name('store_book');
Route::get('/admin/books/{book}/edit', 'BookController@edit')->name('edit_book');
Route::post('/admin/books/{book}/edit', 'BookController@update')->name('update_book');
Route::get('/admin/books/{book}/delete', 'BookController@destroy')->name('delete_book');

Route::get('/admin/publishers', 'PublisherController@index')->name('all_publishers');
Route::get('/admin/publishers/create', 'PublisherController@create')->name('create_publisher');
Route::post('/admin/publishers/create', 'PublisherController@store')->name('store_publisher');
Route::get('/admin/publishers/{publisher}/edit', 'PublisherController@edit')->name('edit_publisher');
Route::post('/admin/publishers/{publisher}/edit', 'PublisherController@update')->name('update_publisher');
Route::get('/admin/publishers/{publisher}/delete', 'PublisherController@destroy')->name('delete_publisher');

Route::get('/admin/authors', 'AuthorController@index')->name('all_authors');
Route::get('/admin/authors/create', 'AuthorController@create')->name('create_author');
Route::post('/admin/authors/create', 'AuthorController@store')->name('store_author');
Route::get('/admin/authors/{author}/edit', 'AuthorController@edit')->name('edit_author');
Route::post('/admin/authors/{author}/edit', 'AuthorController@update')->name('update_author');
Route::get('/admin/authors/{author}/delete', 'AuthorController@destroy')->name('delete_author');
Route::get('/admin/authors/{author}', 'AuthorController@show')->name('show_author');


