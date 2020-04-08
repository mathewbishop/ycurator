<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/current-articles', 'HackerNewsController@GetArticles');

Route::get('/user-keywords', 'CurationCriteriaController@GetKeywordsByUser');


// Icebox feature
// Route::get('/saved-articles', 'SavedArticlesController@SavedArticlesByUser');
// Route::post('/save-article', 'SavedArticlesController@SaveArticle');