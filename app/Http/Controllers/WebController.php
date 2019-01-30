<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Passport;

class WebController extends Controller
{
    public function deleteTransaction(Transaction $transaction) 
    {
        $transaction->delete();
        return redirect('/transactions');
    }

    public function deletePassport(Passport $passport) 
    {
        $passport->delete();
        return redirect('/passports');
    }
}
