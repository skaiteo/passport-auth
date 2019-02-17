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

/**
 * The auth-related APIs
 */
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

/**
 * The resource APIs
 */
$resourceAPIs = function () {
    // Route::apiResources([
    //     'passports' => 'PassportController',
    //     'transactions' => 'TransactionController'
    // ]);

    Route::apiResource('passports', 'PassportController');
    Route::apiResource('transactions', 'TransactionController');
    
    Route::post('users/search', 'UserController@search');
    Route::get('massive-transactions', 'TransactionController@massiveReturn');
};

Route::group(['middleware' => ['auth:api']], $resourceAPIs);

Route::group(['prefix' => 'no-auth'], $resourceAPIs);

Route::post('test-image', function () {
    $image_name = request()->file('image')->getRealPath();
    JD\Cloudder\Facades\Cloudder::upload($image_name, null);

    list($width, $height) = getimagesize($image_name);
    $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);

    return $image_url;
});