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

//RESOURCE DE CATEGORYCONTROLLER

Route::get('/category','CategoryController@index')->middleware('auth');;

Route::get('/category/create','CategoryController@create')->middleware('auth');;
Route::post('/category/create','CategoryController@pcreate')->middleware('auth');;

Route::post('/category','CategoryController@store')->middleware('auth');;

Route::get('/category/{id}','CategoryController@show')->middleware('auth');;

Route::get('/category/{id}/edit','CategoryController@edit')->middleware('auth');;
Route::post('/category/{id}/edit','CategoryController@pedit')->middleware('auth');;

Route::put('/category/{id}','CategoryController@update')->middleware('auth');;

Route::delete('/category/{id}','CategoryController@destroy')->middleware('auth');;

//AUTENTIFICACIÓ DE USUARIS

Route::get('/catalog/buscar', 'CatalogController@search')->middleware('auth');

Route::put('/catalog/lloger/{id}', 'CatalogController@putRent')->middleware('auth');

Route::put('/catalog/return/{id}', 'CatalogController@putReturn')->middleware('auth');

Route::put('/catalog/delete/{id}', 'CatalogController@deleteMovie')->middleware('auth');

Route::get('/', 'HomeController@getHome');

Route::get('inici/', function() {
    return view('inici');
});

Route::get('inici/{nom}', function($nom)
{
    return view('inici', array('user' => $nom));
});




Route::get('catalog/', 'CatalogController@getIndex')->middleware('auth');

Route::get('catalog/show/{id}', 'CatalogController@getShow')->middleware('auth');
Route::post('catalog/show/{id}', 'CatalogController@postCreateR')->middleware('auth');

Route::get('catalog/create/', 'CatalogController@getCreate')->middleware('auth');

Route::get('catalog/edit/{id}', 'CatalogController@getEdit')->middleware('auth');

Route::post('catalog/create', 'CatalogController@postCreate')->middleware('auth');

Route::put('catalog/edit/{id}', 'CatalogController@putEdit')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
