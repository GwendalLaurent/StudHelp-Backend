<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserHasFavorite;
class UserHasFavoriteController extends Controller
{


    public function deleteFavForUser(Request $request)
    {
        return UserHasFavorite::where('user_email', $request->input('user_email'))->where('course_id', $request->input('course_id'))->delete();
    }

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
        return UserHasFavorite::create($request->all());
    }

    /**
     * Returns the list of favorite courses of the given user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_email)
    {
        return UserHasFavorite::where('user_email', $user_email)->get();
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
