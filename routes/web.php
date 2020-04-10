<?php

use App\Http\Controllers\HackerNewsController;
use Illuminate\Support\Facades\Auth;
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
    return view('index');
});

Auth::routes();

Route::get('/criteria', function () {
    return view('criteria');
})->middleware("auth");

Route::get('/home', 'HomeController@index')->name('home');

