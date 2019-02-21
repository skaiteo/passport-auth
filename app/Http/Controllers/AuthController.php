<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        // $request->phone_number = '6' . $request->phone_number; //add a '6' in front of the phone number
        $data = $request->validate([
            'phone_number' => 'required|string'
        ]);
        // return array($data, $request->phone_number);
        
        // $phNum = $request->validate([
        //     'phone_number' => 'required|string'
        // ]);
        $user = User::where('phone_number', $request->phone_number)->first();
        $notGhost = isset($user->email);
        $newID;

        // return isset($user)? 'found user' : 'user not found';

        if ($request->has('email')) { //when there's extra info given
            if (isset($user) && $notGhost) {
                $request->validate([
                    'phone_number' => 'required|string|unique:users' // just to trigger the "phone number taken error
                ]);
            }
            $extraInfo = $this->doValidation($request);
            $extraInfo['password'] = bcrypt($extraInfo['password']); //brcrypt password

            // $validated = array_merge($validated, $extraInfo); //add extraInfo to the lonely phone number
    
            //Generate master code
            if ($request->has('master_code')) { //determine if master code is given
                $extraInfo['master_id'] = User::where('master_code', request('master_code'))->first()->id;
                $extraInfo['master_code'] = null;
            } else {
                do {
                    $mCode = str_random(6);
                    $codeExists = User::where('master_code', $mCode)->exists();
                } while ($codeExists);
    
                $extraInfo['master_code'] = $mCode;
            }

            $newID = User::updateOrCreate($data, $extraInfo)->id;
        }
        else { //this is when there's no extra info
            if (isset($user)) {
                $newID = $user->id;
            } else {
                $newID = User::create($data)->id;
            }
        }

        // return (isset($extraInfo)) ? 'true' : 'false';

        // $user = isset($extraInfo) ?
        //     User::updateOrCreate($phNum, $extraInfo) :
        //     User::updateOrCreate($phNum);

        // $user = new User($validated);
        // $user->save();

        return response()->json([
            'message' => 'Successfully created user!',
            'id' => $newID
        ], 201);
    }
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function doValidation($request) 
    {
        return $request->validate([
            'username' => 'required|string',
            'company_name' => 'string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'd_o_b' => 'required|date',
            'master_code' => 'string'
        ]);
    }

    // public function handleNew($request) {
    //     $extraInfo = 

    //     return $extraInfo;
    // }
}
