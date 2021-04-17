<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Jobs\SendPushNotification;

use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    /**
     * Get all the adverstisements for a single user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_email)
    {
        return Advertisement::where('user_email', $user_email)->get();
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
        $ad = Advertisement::create($request->all());
        $this->dispatch(new SendPushNotification($ad));

        return $ad;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Advertisement::where('id', $id)->get();
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
       $ad = Advertisement::find($id);
       $ad->update($request->all());
       return $ad;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Advertisement::destroy($id);
    }
}
