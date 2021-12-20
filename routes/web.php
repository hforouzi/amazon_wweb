<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Search\Amazon;
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
    return view('auth/login');
});
Route::get('/products', 'Products\ProductsController@index')->name('products');
Route::get('/products/index', 'Products\ProductsController@index')->name('products.index');
Route::get('/products/add', 'Products\ProductsController@store')->name('products.add');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/amazon', "Search\Amazon\AmazonSearchController@index")->name('amazon.index');
Route::post('/searchbyterm', "Search\Amazon\AmazonSearchController@searchbyterm")->name('amazon.searchbyterm');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');
