<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Passport;
use Illuminate\Validation\Rule;

class PassportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $passports = Passport::all();
        $user = auth()->user();
        $passports = $user->passports;

        foreach ($passports as $passport) {
            $passport->d_o_b = substr($passport->d_o_b, 2);
            $passport->expiry_date  = substr($passport->expiry_date, 2);
        }

        return $passports;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ppNum = $request->passport_num;
        $passport = Passport::where('passport_num', $ppNum)->first();
        if (! $passport) {
            $validated = $request->validate([
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'passport_num' =>  'required|string|unique:passports',
                'country' =>  'required|string',
                'd_o_b' =>  'required|string',
                'gender' =>  'required|string',
                'expiry_date' =>  'required|string'
            ]);

            // Adding 2 year digits for d_o_b
            $yob = substr($request->d_o_b, 0, 2);
            if ($yob > date("y")) {  //bigger than current 2-year digit
                $validated['d_o_b'] = 19 . $validated['d_o_b'];
            } else {
                $validated['d_o_b'] = 20 . $validated['d_o_b'];
            }
            
            // Adding 2 year digits for expiry_date
            $validated['expiry_date'] = 20 . $validated['expiry_date'];

            //Adding user id
            $user = auth()->user();
            $validated['user_id'] = ($user) ? $user->id : 0; //if not authenticated, then id = 0

            $passport = new Passport($validated);
            $passport->save();
        }

        return response()->json([
            'message' => 'Successfully created passport!',
            'id' => $passport->id
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Passport $passport)
    {
        $passport->d_o_b  = substr($passport->d_o_b, 2);
        $passport->expiry_date  = substr($passport->expiry_date, 2);
        
        return $passport;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Passport $passport)
    {
        $validated = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'passport_num' => [
                'required',
                'string',
                Rule::unique('passports')->ignore($passport->id)
            ],
            'country' =>  'required|string',
            'dob' =>  'required|string',
            'gender' =>  'required|string',
            'expiry_date' =>  'required|string'
        ]);

        $passport->update($validated);

        return response()->json([
            'message' => 'Successfully updated passport!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Passport $passport)
    {
        $passport->user_id = null;
        $passport->save();

        return response()->json([
            'message' => 'Successfully deleted passport!'
        ]);
    }
}
