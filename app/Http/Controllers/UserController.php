<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller
{

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
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
        if (User::where('email', '=', $request->input('email'))->count() > 0 || User::where('login', '=', $request->input('login'))->count()) {
            // An user already has one of these elems
            echo "error one user already has the same auth";
            return;
        }
        else{
            $request->merge([
                'password' => bcrypt($request->input('password'))
            ]); // hasing the password
            return User::create($request->all());
        }
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
