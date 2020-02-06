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
        Route::get('forcedelete/{id}','CategoryController@forceDelete')->name('forcedelete');
        Route::get('restore/{id}','CategoryController@restore')->name('restore');
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
        Route::get('forcedelete/{id}','NewsCategoryController@forceDelete')->name('forcedelete');
        Route::get('restore/{id}','NewsCategoryController@restore')->name('restore');
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
        Route::get('forcedelete/{id}','ProductController@forceDelete')->name('forcedelete');
        Route::get('restore/{id}','ProductController@restore')->name('restore');
        Route::get('show_images_by_product/{id}','ProductController@showImages')->name('show_images');
        Route::get('change_hot/{id}','ProductController@changeHot')->name('change_hot');

        Route::get('add_image_description/{idProduct}','ProductController@addImageDescription')->name('add.image.description');
        Route::post('store_image_description','ProductController@storeImageDescription')->name('store.image.description');
        Route::get('get_image_description/{id}','ProductController@getImageDescription')->name('get.image.description');
        Route::get('delete_image_description/{id}','ProductController@forceDeleteImageDescription')->name('forcedelete.image.description');
    });

    Route::group([
        'prefix' => 'rating',
        'as' => 'rating.'
    ],function(){
        Route::get('index', 'RatingController@index')->name('index');
        Route::get('forcedelete/{id}', 'RatingController@forceDelete')->name('forcedelete');
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
        Route::get('forcedelete/{id}','UserController@forceDelete')->name('forcedelete');
        Route::get('edit_status/{id}','UserController@editStatus')->name('edit_status');
        Route::get('open_or_block/{id}','UserController@openOrBlock')->name('open_or_block');
        Route::get('show_products_by_user_id/{id}','UserController@showProducts')->name('show_products');
    });

    Route::group([
        'prefix' => 'trademark',
        'as' => 'trademark.'
    ],function(){
        Route::get('index', 'TrademarkController@index')->name('index');
        Route::get('create', 'TrademarkController@create')->name('create');
        Route::post('store', 'TrademarkController@store')->name('store');
        Route::get('edit/{id}', 'TrademarkController@edit')->name('edit');
        Route::put('update/{id}','TrademarkController@update')->name('update');
        Route::get('delete/{id}','TrademarkController@destroy')->name('destroy');
        Route::get('forcedelete/{id}','TrademarkController@forceDelete')->name('forcedelete');
        Route::get('restore/{id}','TrademarkController@restore')->name('restore');
    });

    Route::group([
        'prefix' => 'post',
        'as' => 'post.'
    ],function(){
        Route::get('index', 'PostController@index')->name('index');
        Route::get('create', 'PostController@create')->name('create');
        Route::get('show/{id}', 'PostController@show')->name('show');
        Route::get('edit/{id}', 'PostController@edit')->name('edit');
        Route::put('update/{id}', 'PostController@update')->name('update');
        Route::post('store', 'PostController@store')->name('store');
        Route::get('delete/{id}','PostController@destroy')->name('destroy');
        Route::get('forcedelete/{id}','PostController@forceDelete')->name('forcedelete');
        Route::get('restore/{id}','PostController@restore')->name('restore');
    });

    Route::group([
        'prefix' => 'image',
        'as' => 'product_image.'
    ],function(){
        Route::get('index/{id}', 'ProductImageController@index')->name('index');
        Route::get('create', 'ProductImageController@create')->name('create');
        Route::post('store', 'ProductImageController@store')->name('store');
        Route::get('delete/{id}','ProductImageController@destroy')->name('destroy');
    });

    Route::group([
        'prefix' => 'order',
        'as' => 'order.'
    ],function(){
        Route::get('index', 'OrderController@index')->name('index');
        Route::get('create', 'OrderController@create')->name('create');
        Route::get('show/{id}', 'OrderController@show')->name('show');
        Route::post('store', 'OrderController@store')->name('store');
        Route::get('edit/{id}', 'OrderController@edit')->name('edit');
        Route::put('update/{id}', 'OrderController@update')->name('update');
        Route::get('show_products_by_order_id/{order_id}', 'OrderController@showProducts')->name('show_products');
    });

    Route::group([
        'prefix' => 'ajax'
    ],function(){
        Route::get('get_trademarks/{id}', 'TrademarkController@getTrademarks')->name('trademark.get');
    });
});

Route::group([
    'namespace' => 'Frontend',
    'as' => 'frontend.'
], function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home/detail_product/{id}', 'HomeController@detailProduct')->name('detail_product');
    Route::get('/home/detail_category/{id}', 'HomeController@detailCategory')->name('detail_category');
    Route::get('/home/detail_category/{idCategory}/trademark/{idTrademark}','HomeController@detailCategoryByTrademark')->name('detail_category_by_trademark');
    Route::get('/home/detail_category/{idCategory}/price/{minPrice}/{maxPrice}','HomeController@detailCategoryByPrice')->name('detail_category_by_price');
    Route::get('/home/detail_category/{idCategory}/trademark/{idTrademark}/price/{minPrice}/{maxPrice}','HomeController@detailCategoryByTrademarkAndPrice')->name('detail_category_by_trademark_and_price');
});

Route::group([
'namespace' => 'Backend',
'prefix' => 'ajax'
// 'middleware' => 'CheckLoginUser'
], function(){
    Route::post('/rating_product/{id}', 'RatingController@store')->name('rating.store');
});

Auth::routes();
