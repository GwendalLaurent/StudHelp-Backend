<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{

    public function updateFirebaseToken($user_email, Request $request)
    {
        $fields = $request->validate([
            'firebase_token' => 'required|string',
        ]);

        $user = User::where('email', $user_email)->first();
        $user->update(['firebase_token' => $request->input('firebase_token')]);
        return $user->makeHidden(['firebase_token']);
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
            $user->update(['login' => $fields['login']]);
        }
        if($request->has('name')){
            $user->update(['name' => $fields['name']]);
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

        if(Hash::check($request->input('old_password'),$user['password'])){
            $user->update(['password' => bcrypt($fields['password'])]);
            $response = [
                'user' => $user
            ];
            return response($response, 201);
        }else{
            $response = [
                'message' => 'The given data was invalid',
                'errors' => ['password' => ['Wrong password']]
            ];
            return response($response, 422);
        }
    }

    public function uploadProfilePicture(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'picture' => 'required|image:jpeg,png,jpg,svg|max:2048'
        ]);

        $user = User::where('email', $fields['email'])->first();
        if (!$user){
            return response([
            'message' => 'Wrong email'
            ], 401);
        }
        $old_picture = $user->picture;
        if ($old_picture != NULL){
            Storage::disk('public')->delete($old_picture);
        }

        $uploadFolder = 'users';
        $image = $request->file('picture');
        $image_uploaded_path = $image->store($uploadFolder, 'public');
        $uploadedImageResponse = [
            "image_name" => basename($image_uploaded_path),
            "image_url" => Storage::disk('public')->url($image_uploaded_path),
            "mime" => $image->getClientMimeType()
        ];

        $user->update(['picture' => $image_uploaded_path]);
        return response($uploadedImageResponse, 200);
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
