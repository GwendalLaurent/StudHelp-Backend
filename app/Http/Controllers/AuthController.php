<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\SocialLink;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'login' => 'required|string|unique:users,login',
            'email' => 'required|string|unique:users,email',
            'name' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);
    
        $user = User::create([
            'login' => $fields['login'],
            'email' => $fields['email'],
            'name' => $fields['name'],
            'password' => bcrypt($fields['password'])
        ]);

        $social_links = SocialLink::create([
            'user_email' => $fields['email']
        ]);

        $token = $user->createToken('StudHelp')->plainTextToken;

        $response = [
            'user' => $user->makeHidden['firebase_token'],
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string'
        ]);
        
        $user = User::where('login', $fields['login'])->first();
        if (!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('StudHelp')->plainTextToken;

        $response = [
            'user' => $user->makeHidden(['firebase_token']),
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}
