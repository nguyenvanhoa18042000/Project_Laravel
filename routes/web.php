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

Route::group([
    'namespace' => 'Backend',
    'prefix' => 'admin',
    'as' => 'backend.'
], function (){
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::group([
    	'prefix' => 'category',
    	'as' => 'category.'
    ],function(){
    	Route::get('index', 'CategoryController@index')->name('index');
    	Route::get('create', 'CategoryController@create')->name('create');
    	Route::post('store', 'CategoryController@store')->name('store');
    	Route::get('edit/{id}', 'CategoryController@edit')->name('edit');
    	Route::put('update/{id}','CategoryController@update')->name('update');
    	Route::get('delete/{id}','CategoryController@destroy')->name('destroy');
    	Route::get('edit_status/{id}','CategoryController@editStatus')->name('edit_status');
    });

    Route::group([
    	'prefix' => 'product',
    	'as' => 'product.'
    ],function(){
    	Route::get('index', 'ProductController@index')->name('index');
    	Route::get('create', 'ProductController@create')->name('create');
    	Route::post('store', 'ProductController@store')->name('store');
    	Route::get('edit/{id}', 'ProductController@edit')->name('edit');
    	Route::put('update/{id}','ProductController@update')->name('update');
    	Route::get('delete/{id}','ProductController@destroy')->name('destroy');
    	Route::get('edit_status/{id}','ProductController@editStatus')->name('edit_status');
    });
});
