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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

//storing the APIs in this variable to be used later
$resourceAPIs = function () {
    // Route::apiResources([
    //     'passports' => 'PassportController',
    //     'transactions' => 'TransactionController'
    // ]);

    Route::apiResource('passports', 'PassportController');
    Route::apiResource('transactions', 'TransactionController');
    
    Route::post('users/search', 'AuthController@search');
};

Route::group(['middleware' => ['auth:api']], $resourceAPIs);

Route::group(['prefix' => 'no-auth'], $resourceAPIs);
