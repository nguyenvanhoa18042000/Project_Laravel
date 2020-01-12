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
    'middleware' => 'auth',
    'prefix' => 'admin',
    'as' => 'backend.'
], function (){
    Route::get('/home', 'DashboardController@index')->name('home');

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
        Route::get('show_products_by_category/{category_id}','CategoryController@showProducts')->name('show_products');
    });

    Route::group([
        'prefix' => 'news_category',
        'as' => 'news_category.'
    ],function(){
        Route::get('index', 'NewsCategoryController@index')->name('index');
        Route::get('create', 'NewsCategoryController@create')->name('create');
        Route::post('store', 'NewsCategoryController@store')->name('store');
        Route::get('edit/{id}', 'NewsCategoryController@edit')->name('edit');
        Route::put('update/{id}','NewsCategoryController@update')->name('update');
        Route::get('delete/{id}','NewsCategoryController@destroy')->name('destroy');
        Route::get('edit_status/{id}','NewsCategoryController@editStatus')->name('edit_status');
        Route::get('show_posts_by_news_category/{news_category_id}','NewsCategoryController@showPosts')->name('show_posts');
    });

    Route::group([
    	'prefix' => 'product',
    	'as' => 'product.'
    ],function(){
    	Route::get('index', 'ProductController@index')->name('index');
    	Route::get('create', 'ProductController@create')->name('create');
        Route::get('show', 'ProductController@show')->name('show');
    	Route::post('store', 'ProductController@store')->name('store');
    	Route::get('edit/{id}', 'ProductController@edit')->name('edit');
    	Route::put('update/{id}','ProductController@update')->name('update');
    	Route::get('delete/{id}','ProductController@destroy')->name('destroy');
    	Route::get('edit_status/{id}','ProductController@editStatus')->name('edit_status');
        Route::get('show_images_by_product/{id}','ProductController@showImages')->name('show_images');
    });

    Route::group([
        'prefix' => 'user',
        'as' => 'user.'
    ],function(){
        Route::get('index', 'UserController@index')->name('index');
        Route::get('create', 'UserController@create')->name('create');
        Route::get('show/{id}', 'UserController@show')->name('show');
        Route::post('store', 'UserController@store')->name('store');
        Route::post('block', 'UserController@blockUser')->name('block');
        Route::get('delete/{id}','UserController@destroy')->name('destroy');
        Route::get('edit_status/{id}','UserController@editStatus')->name('edit_status');
        Route::get('open_or_block/{id}','UserController@openOrBlock')->name('open_or_block');
        Route::get('show_products_by_user_id/{id}','UserController@showProducts')->name('show_products');
    });

    Route::group([
        'prefix' => 'post',
        'as' => 'post.'
    ],function(){
        Route::get('index', 'PostController@index')->name('index');
        Route::get('create', 'PostController@create')->name('create');
        Route::get('show/{id}', 'PostController@show')->name('show');
        Route::post('store', 'PostController@store')->name('store');
        Route::post('block', 'PostController@blockUser')->name('block');
        Route::get('delete/{id}','PostController@destroy')->name('destroy');
        Route::get('edit_status/{id}','PostController@editStatus')->name('edit_status');
    });

    Route::group([
        'prefix' => 'image',
        'as' => 'image.'
    ],function(){
        Route::get('index', 'ImageController@index')->name('index');
        Route::get('create', 'ImageController@create')->name('create');
        Route::get('show/{id}', 'ImageController@show')->name('show');
        Route::post('store', 'ImageController@store')->name('store');
        Route::get('delete/{id}','ImageController@destroy')->name('destroy');
        Route::get('edit_status/{id}','ImageController@editStatus')->name('edit_status');
    });

    Route::group([
        'prefix' => 'order',
        'as' => 'order.'
    ],function(){
        Route::get('show_products_by_order_id/{order_id}', 'OrderController@showProducts')->name('show_products');
    });
});

Route::group([
    'namespace' => 'Frontend',
    'as' => 'frontend.'
], function (){
    Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();
