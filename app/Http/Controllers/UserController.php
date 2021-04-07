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
        $user = User::where('email', $user_email);
        if($request->has('login')){
            $user->update(['login' => $request->input('login')]);
        }
        if($request->has('name')){
            $user->update(['name' => $request->input('name')]);
        }
        return $user->get();
    }

    public function updatePassword($user_email, Request $request)
    {
        $user = User::where('email', $user_email);
        if(Hash::check($request->input('oldpassword'),$user->get('password')[0]['password'])){
            $user->update(['password' => Hash::make($request->input('password'))]);
            return $user->get();
        }else{
            echo "error";
            return;
        }
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
