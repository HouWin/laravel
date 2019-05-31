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
    echo asset('storage/file.txt');
    //return view('welcome');
});

Auth::routes();


Route::get('/loginAuth', 'HomeController@login_auth')->name('loginAuth');
Route::get('/hello','HelloController@index');

Route::middleware('auth')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/myShop','ShopController@my_shop')->name('myshop');
    Route::get('/createShop','ShopController@create')->name('createShop');
    Route::post('/createShopSave','ShopController@add')->name('addShop');
    Route::get('/editShop/{id}','ShopController@edit')->name('editShop');
    Route::get('/shopInfo/{shop}','ShopController@shopInfo')->name('shopInfo');
    Route::post('/upShop/{shop}','ShopController@upShop')->name('upShop');

    Route::get('/goods/create','GoodsController@create')->name('createGoods');
    Route::post('/goods/createResult','GoodsController@store')->name('createGoodsResult');
    Route::get('/goods/list','GoodsController@index')->name('GoodsList');
    Route::get('/goods/up/{id}','GoodsController@edit')->name("goodsEdit");
    Route::get('/goods/show/{id}','GoodsController@show')->name('goodsShow');
    Route::post('/goods/update/{id}','GoodsController@update')->name("goodsUpdate");

    Route::post('/file/upload','FileController@add')->name('upload');
    Route::post('/file/createDbData','FileController@createDbData')->name('createDbData');
    Route::post('/delete/file/{id}','FileController@delete');
});

