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

/*
Route::view(uri, view_name, [array of data]) suitable if you only need to return a view.
When using route parameters, DO NOT USE view, data, status and headers (reserved by Laravel).
*/
Route::view('/weird-greeting', 'weird_greeting', ['message' => 'That is weird!']);

/*
To list all routes
php artisan route:list or ./vendor/bin/sail artisan route:list -v (show middleware assigned to each route) --except-vendor (hide third-party routes)
*/

Route::get('/user/{id}/comments/{comment_id}/order/{order?}', function(Request $request, $userId, $commentId, $order='desc') {
    // do something with $request

    return 'User '.$userId.' with comment '.$commentId.' sorted '.$order;
});

/*
Parameter constraints can also be defined as regex. Ex.: where(['id' => '[0-9]+', 'name' => '[a-z]+', 'category' => '(movie|song|painting)'])
*/
Route::get('/user/{id}/{name}/category/{category}', function($userId, $name, $category) {
    return 'User '.$userId.' named '.$name.' of category '.$category;
})->whereNumber('id')->whereAlpha('name')->whereIn('category', ['movie', 'song', 'painting']);

/*
Global contraints defined inside App\Providers\RouteServiceProvider's boot() with Route::pattern(param_name, regex_string)
*/
Route::get('/call/{devil}', function($devilNumber) {
    return 'You called the devil!';
});

/*
Explicitly allow / to be part of parameter value
*/
Route::get('/search/{search?}', function($search=null) {
    return $search;
})->where('search', '.*');