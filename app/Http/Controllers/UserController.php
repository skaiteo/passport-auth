<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    
    /**
     * Filter the results of user from given string
     */
    public function search(Request $request)
    {
        $key = $request->keyword;

        return User::select('id', 'username', 'company_name')
            ->where('username', 'ilike', '%'.$key.'%')
            ->get();
    }

    /**
     * Return the master of the current user
     */
    public function getMaster() 
    {
        return auth()->user()->master;
    }
    
    /**
     * Return the slaves of the current user
     */
    public function getSlaves() 
    {
        return auth()->user()->slaves;
    }
}
