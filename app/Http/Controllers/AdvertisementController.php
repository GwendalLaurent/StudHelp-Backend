<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\AdvertisementHasTags;
use App\Models\UserHasBookmarks;
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
        $ads = Advertisement::where('user_email', $user_email)
        ->join('users', 'users.email', '=', 'user_email')
        ->join('courses', 'courses.id', '=', 'course_id')
        ->leftjoin('advertisement_has_pictures', 'advertisement_has_pictures.advertisement_id', '=', 'advertisements.id')
        ->select('advertisements.*', 'users.name', 'advertisement_has_pictures.picture', 'courses.name as course_name')->latest()->get();

        $ads->map(function($item){
            $item["tags"] = AdvertisementHasTags::where('advertisement_id', $item['id'])->get();
        });

        return $ads;
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
        $ads = Advertisement::where('advertisements.id', $id)
        ->join('users', 'users.email', '=', 'advertisements.user_email')
        ->join('courses', 'courses.id', '=', 'course_id')
        ->leftjoin('advertisement_has_pictures', 'advertisement_has_pictures.advertisement_id', '=', 'advertisements.id')
        ->select('advertisements.*', 'users.name', 'advertisement_has_pictures.picture', 'courses.name as course_name')->latest()->get();

        $ads->map(function($ad){
            $ad["tags"] = AdvertisementHasTags::where('advertisement_id', $ad["id"])->get();
        });

        return $ads;
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
        UserHasBookmarks::where("advertisement_id", $id)->delete();
        return Advertisement::destroy($id);
    }
}
