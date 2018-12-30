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
        return Passport::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'passport_num' =>  'required|string|unique:passports',
            'country' =>  'required|string',
            'd_o_b' =>  'required|string',
            'gender' =>  'required|string',
            'expiry_date' =>  'required|string'
        ]);

        $passport = new Passport($validated);

        $passport->save();

        return response()->json([
            'message' => 'Successfully created passport!'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Passport::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $passport->delete();

        return response()->json([
            'message' => 'Successfully deleted passport!'
        ]);
    }
}
