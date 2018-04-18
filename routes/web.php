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

/*
* sign in and up pages routes
*
*/

Route::get('/add-to-cart/{id}', [
  'uses' => 'ProductsController@getAddToCart',
  'as' => 'product.addToCart'
]);
Route::get('/shopping-cart', [
  'uses' => 'ProductsController@getCart',
  'as' => 'product.shoppingCart'
]);
Route::get('/to-database', [
  'uses' =>'ProductsController@toDatabase',
  'as' => 'product.added'
]);
Route::group(['prefix' =>'user'], function() {
  Route::group(['middleware' => 'guest'] ,function() {
    Route::get('/signup', [
      'uses' => 'UserController@getSignup',
      'as' => 'user.signup'
    ]);
    Route::post('/signup', [
      'uses' => 'UserController@postSignup',
      'as' => 'user.singin'
    ]);
    Route::get('/signin', [
      'uses' => 'UserController@getSignin',
      'as' => 'user.signin'
    ]);
    Route::post('/signin', [
      'uses' => 'UserController@postSignin',
      'as' => 'user.singin'
    ]);
  });
  Route::group(['middleware' => 'auth'] ,function() {
  Route::get('/profile', [
    'uses' => 'UserController@getProfile',
    'as' => 'user.profile'
  ]);
  Route::get('/logout', [
      'uses' => 'UserController@getLogout',
      'as' => 'user.logout'
    ]);
  } );
Route::get('login', function () { return redirect('user/signin'); })->name('login');
});



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
