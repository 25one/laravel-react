<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function(){ //!!!route('login')
    return redirect(route('login'));
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::name('home')->get('/home', 'ProductController@index');
    Route::name('product')->get('/product/{id}', 'ProductController@product');

    Route::name('comment')->get('/product/{id}/comment', 'ProductController@comment');
    Route::name('addcomment')->post('/addcomment', 'ProductController@addcomment');
    Route::name('removecomment')->post('/removecomment', 'ProductController@removecomment');

    Route::name('cart')->get('/cart', 'ProductController@cart');
    Route::name('tocart')->post('/tocart', 'ProductController@tocart');
    Route::name('clearall')->post('/clearall', 'ProductController@clearall');
    Route::name('clearone')->post('/clearone', 'ProductController@clearone');
    Route::name('mailer')->post('/mailer', 'ProductController@mailer');
});

Route::middleware('admin')->group(function () {
    Route::name('dashboard')->get('/dashboard', 'AdminController@index');
    Route::name('users')->resource('users', 'AdminController');
});