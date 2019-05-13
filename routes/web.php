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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index');
Route::get('/admin/books', 'BookController@index')->name('all_books');
Route::get('/admin/books/create', 'BookController@create')->name('create_book');
Route::post('/admin/books/create', 'BookController@store')->name('store_book');
Route::get('/admin/books/{book}/edit', 'BookController@edit')->name('edit_book');
Route::post('/admin/books/{book}/edit', 'BookController@update')->name('update_book');
Route::get('/admin/books/{book}/delete', 'BookController@destroy')->name('delete_book');
