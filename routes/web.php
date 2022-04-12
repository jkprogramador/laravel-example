<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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


/*
Most basic routing accepts URI and a closure.
 */
Route::get('/greeting', function() {
    return 'Hello World';
});

/*
Registering routes that respond to any HTTP verb.

Because a CSRF token is required when making requests like POST, PUT, DELETE etc,
I have disabled the following routes inside the $except property of \App\Http\Middleware\VerifyCsrfToken.
 */
Route::match(['get', 'post'], '/checkout', function() {
    return 'Sale completed';
});

/*
Type-hint any dependency in the callback. Any dependencies will be resolved and injected by the service container.
https://laravel.com/docs/9.x/container
*/
Route::delete('/erase', function(Request $request) {
    return 'Erased';
});


Route::put('/edit-cart', function() {
    return 'Edit finished';
});

/*
Perform redirect with Route::redirect(from, to).
By default, 302 status. Specify 301 (permanent redirect) as Route::redirect(from, to, 301) or Route::permanentRedirect.
When using route paramenters, DO NOT USE destination nor status (reserved by Laravel).
*/
Route::redirect('/finish-shopping', '/checkout');