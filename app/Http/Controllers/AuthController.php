<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            'user' => $user,  
            'token' => $token->plainTextToken
        ]);
    }

    // register method
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
    
        event(new Registered($user));
    
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json(['user' => $user, 'token' => $token]);
    }

}
