<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //  
    public function login(Request $request){
        $request->validate([
            'email' =>'required|email',
            'password' =>'required',
        ]);
        
        if(!Auth::attempt(['email' => $request->email,'password' => $request->password])){
            return response()->json([
                'error' => 'Invalid Credentials'
            ],401);
        }

        /** @var \App\Models\MyUserModel $user **/
        $user = auth()->user();
        $token = $user->createToken('api_token');
            
        return response()->json([
            'data' => $user,  
            'token' => $token->plainTextToken
        ]);
    }

    // register method
}
