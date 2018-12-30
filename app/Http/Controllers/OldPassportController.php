<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Passport;

class OldPassportController extends Controller
{
    public function index() {
        return Passport::all();
    }
    
    public function create(Request $request) {

        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'passport_num' =>  'required|string|unique:passports',
            'country' =>  'required|string',
            'dob' =>  'required|string',
            'gender' =>  'required|string',
            'expiry_date' =>  'required|string'
        ]);

        $passport = new Passport($request->toArray());

        $passport->save();

        return response()->json([
            'message' => 'Successfully created passport!'
        ], 201);

    }

    public function delete(Request $request) {

        $request->validate([
            'passport_num' => 'required|string'
        ]);

        $passportNum = request('passport_num');

        $delPassport = Passport::where('passport_num', $passportNum)->first();

        if ($delPassport) 
            $delPassport->delete();

        return response()->json([
            'message' => ($delPassport) ? 
                'Successfully deleted passport!' :
                'Passport not found!'
        ]);
        
    }
}