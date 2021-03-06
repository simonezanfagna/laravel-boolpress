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

Route::get('/', 'HomeController@index')->name('public.home');
Route::get('/contatti','HomeController@contatti')->name('contattiShow');
Route::post('/contatti','HomeController@contattiStore')->name('contattiStore');
Route::get('/grazie','HomeController@grazie')->name('contattiGrazie');

Route::get('/blog','PostController@index')->name('blogPublic');
Route::get('/blog/{slug}','PostController@show')->name('blogShow');
Route::get('/blog/categorie/{slug}','PostController@postCategoria')->name('blogCategory');
Route::get('/blog/tag/{slug}','PostController@postTag')->name('blogTag');


Auth::routes(['register' => false]); //questo comando non permette la registrazione


Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')->group(function (){

  Route::get('/', 'HomeController@index')->name('home');

  Route::resource('/posts','PostController');

  Route::get('/account', 'HomeController@account')->name('account');
});
