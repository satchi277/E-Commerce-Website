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

Route::prefix('/admin')->namespace('Admin')->group(function(){
    //All the admin routes will be Defined Here :-
    Route::match(['get','post'],'/','AdminController@login');
    route::group(['middleware'=>['admin']],function(){
        Route::get('dashboard','AdminController@dashboard');
        //Setting Route
        Route::get('settings', 'AdminController@settings');
        //Admin logout
        Route::get('logout','AdminController@logout');
    });
});

