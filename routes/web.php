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

//Route::any('list', 'ListController');


Route::get('list', 'ListController@index');
Route::any('list/savenewproducts', 'ListController@postSavenewproducts');
Route::any('list/deleteproducts', 'ListController@postDeleteproducts');
