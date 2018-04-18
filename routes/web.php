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
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');

Route::resource('products', 'ProductsController');
Route::resource('categories', 'CategoriesController');
Route::get('/category/{id}', 'CategoriesController@show')->name('category');

//Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/about', function() {
  // return view('pages.about');
// });
// Route::get('/users/{id}', function($id) {
//   return 'This  is user: ' .$id;
// });
