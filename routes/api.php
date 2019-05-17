<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/get_token', 'Api\AuthController@login');
Route::group(['middleware' => 'auth:api'], function (){
    Route::post('/authors', 'Api\AuthorController@index');
    Route::post('/authors/create', 'Api\AuthorController@store');
    Route::post('/authors/{author}/edit', 'Api\AuthorController@update');
    Route::post('/authors/{author}/delete', 'Api\AuthorController@destroy');

    Route::post('/publishers', 'Api\PublisherController@index');
    Route::post('/publishers/create', 'Api\PublisherController@store');
    Route::post('/publishers/{publisher}/edit', 'Api\PublisherController@update');
    Route::post('/publishers/{publisher}/delete', 'Api\PublisherController@destroy');

    Route::post('/books', 'Api\BookController@index');
    Route::post('/books/create', 'Api\BookController@store');
    Route::post('/books/{book}/edit', 'Api\BookController@update');
    Route::post('/books/{book}/delete', 'Api\BookController@destroy');
});
