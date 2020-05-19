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



Auth::routes();

Route::get('/', "HackerNewsController@GetArticles");

Route::get('/criteria', function () {
    return view('criteria');
})->middleware("auth");

// For user's keywords
Route::get('/criteria/keywords', 'CurationCriteriaController@GetKeywordsByUser')->middleware("auth");
Route::post('/criteria/keywords', 'CurationCriteriaController@AddKeyword')->middleware("auth");
Route::delete('/criteria/keywords', 'CurationCriteriaController@DeleteKeyword')->middleware("auth");

// For user comment threshold
Route::get('/criteria/threshold', 'CurationCriteriaController@GetCommentThreshold')->middleware("auth");
Route::post('/criteria/threshold', 'CurationCriteriaController@SetCommentThreshold')->middleware("auth");

