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


// For user's keywords
Route::get('/user-keywords', 'CurationCriteriaController@GetKeywordsByUser');
Route::post('/user-keywords', 'CurationCriteriaController@AddKeyword');
Route::delete('/user-keywords', 'CurationCriteriaController@DeleteKeyword');

// For user comment threshold
Route::get('/user-threshold', 'CurationCriteriaController@GetCommentThreshold');
Route::post('/user-threshold', 'CurationCriteriaController@SetCommentThreshold');