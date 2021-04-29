<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\AdvertisementHasTags;

use Illuminate\Http\Request;

class CourseAdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course_id)
    {
        $ads = Advertisement::where('course_id', $course_id)
        ->join('users', 'users.email', '=', 'advertisements.user_email')
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
