<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Customer;
use App\Payment;
use App\Order;

// Main page
Route::get('/', function () {
    return view('home');
});

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// Ressource REST API routes
Route::resource('order', 'OrderController', ['only' => ['store', 'index', 'create', 'show']]);
Route::resource('payment', 'PaymentController', ['only' => ['store', 'show']]);
Route::resource('customer', 'CustomerController', ['only' => ['store', 'show']]);


// Admin page
Route::get('/admin', ['middleware' => 'auth', function () {
   
    /*
     * Displays a table of all direct debit payments requested so far 
     */
	$orders = Order::orderBy('group', 'asc')->with('payment', 'customer')->get()->all();
    $payments = Payment::all();
    $customers = Customer::all();

    return view('admin', ['orders' => $orders, 'payments' => $payments, 'customers' => $customers]);
}]);

Route::controllers([
   'password' => 'Auth\PasswordController',
]);