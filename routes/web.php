<?php
use App\PeeDeeEff;

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

Route::get('/fpdf', function (App\PeeDeeEff $fpdf) {
    $fpdf->AddPage('P', 'A4');
    $fpdf->SetFont('Courier', 'B', 18);
    $fpdf->centreImage('storage/1.jpg', null, null, -300);
    $fpdf->Output();
});

// Route::delete('/transactions/{transaction}', 'WebController@deleteTransaction');
// Route::delete('/passports/{passport}', 'WebController@deletePassport');

Auth::routes(['verify' => true]);