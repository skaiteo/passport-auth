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
    return redirect('startAdminer.php');
});

// Route::get('/passports', function () {
//     return view('temp.passports', [
//         'passports' => App\Passport::all()
//     ]);
// });

// Route::get('/transactions', function () {
//     return view('temp.transactions', [
//         'transactions' => App\Transaction::all()
//     ]);
// });

Route::delete('/transactions/{transaction}', 'WebController@deleteTransaction');
Route::delete('/passports/{passport}', 'WebController@deletePassport');

// Route::get('/adminer', function () {
//     return redirect('startAdminer.php');
// });
