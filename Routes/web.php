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

use Illuminate\Support\Facades\Route;
use Modules\CategoryModule\Http\Controllers\CategoryModuleController;

/////////////////      Categories          ////////////////////////
Route::resource('/categories', 'CategoryModuleController');
Route::prefix('categories')->group(function() {

    Route::get('/activation/{id}','CategoryModuleController@activate');
    Route::get('/delete/{id}','CategoryModuleController@destroy');

});

/////////////////      Trademarks          ////////////////////////
Route::resource('/trademarks', 'TrademarkController');
Route::prefix('trademarks')->group(function() {

    Route::get('/activation/{id}','TrademarkController@activate');
    Route::get('/delete/{id}','TrademarkController@destroy');

});
