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
// Review controller
Route::get('/new/review', 'ReviewController@createReview');
Route::post('/new/review', 'ReviewController@createReview');

/*
* sign in and up pages routes
*this gets the route to add something to the cart with an specific id.
*
*/

Route::get('/add/{id}', [
  'uses' => 'ProductsController@addToCart',
  'as' => 'product.addToCart'
]);

/*
*this gets the route to the reduce an item by one from the shopping cart with an specific id.
*
*/
Route::get('/reduce/{id}', [
  'uses' => 'ProductsController@reduceByOne',
  'as' => 'product.reduceByOne'
]);
/*
*this gets the route to remove an item from the shopping cart with an specific id.
*/
Route::get('/remove/{id}', [
  'uses' => 'ProductsController@removeItem',
  'as' => 'product.remove'
]);
/*
*this gets the route to add an item to the shopping cart from the products with the specific id.
*/

/*
*this gets the route to show the shoppingcart in the shopping cart with the products that are put in the session/shoppingcart.
*/
Route::get('/shopping-cart', [
  'uses' => 'ProductsController@getCart',
  'as' => 'product.shoppingCart'
]);
/*
*this gets the route to put the order in to the database and
*/
Route::get('/to-database', [
  'uses' =>'ProductsController@toDatabase',
  'as' => 'product.added',
  'middleware' => 'auth'
]);



Route::group(['prefix' =>'user'], function() {
  Route::group(['middleware' => 'guest'] ,function() {
    Route::get('/signup', [
      'uses' => 'UserController@getSignup',
      'as' => 'user.signup'
    ]);
    Route::post('/signup', [
      'uses' => 'UserController@postSignup',
      'as' => 'user.singup'
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
  });
Route::get('/added', [
  'uses' => 'ProductsController@toDatabase',
  'as' => 'order.added'
]);


Route::resource('products', 'ProductsController');
Route::resource('categories', 'CategoriesController');
Route::get('/category/{id}', 'CategoriesController@show')->name('category');
Route::resource('reviews', 'ReviewController');
Route::get('login', function () { return redirect('user/signin'); })->name('login');
Route::get('register', function () { return redirect('user/signup'); })->name('register');
//Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/about', function() {
  // return view('pages.about');
// });
// Route::get('/users/{id}', function($id) {
//   return 'This  is user: ' .$id;
// });
