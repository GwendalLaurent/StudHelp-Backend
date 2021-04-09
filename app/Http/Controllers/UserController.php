<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        // Show a single user
        return User::where('email', $email)->get();
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
    public function update(Request $request, $id)
    {
        //
    }
    
    public function updateLoginAndName($user_email, Request $request)
    {
        $fields = $request->validate([
            'login' => 'string|unique:users,login',
            'name' => 'string'
        ]);

        $user = User::where('email', $user_email)->first();

        if($request->has('login')){
            $user->update(['login' => $request->input('login')]);
        }
        if($request->has('name')){
            $user->update(['name' => $request->input('name')]);
        }

        $response = [
            'user' => $user
        ];

        return response($response, 201);
    }

    public function updatePassword($user_email, Request $request)
    {
        $fields = $request->validate([
            'password' => 'required|string|confirmed'
        ]);

        $user = User::where('email', $user_email)->first();

        if(Hash::check($request->input('oldpassword'),$user->get('password')[0]['password'])){
            $user->update(['password' => bcrypt($fields['password'])]);
            $response = [
                'user' => $user
            ];
            $code = 201;
        }else{
            $response = [
                'message' => 'The given data was invalid',
                'errors' => ['password' => ['Wrong password']]
            ];
            $code = 422;
        }
        return response($response, $code);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
