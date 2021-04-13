<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdvertisementHasPictures;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Storage;
use File;
class AdvertisementHasPicturesController extends Controller
{
            /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        $fields = $request->validate([
            'email' => 'required|string',
            'advertisement_id' => 'required|integer',
            'picture.*' => 'required|image|mimes::jpeg,png,jpg,svg|max:2048'
        ]);

        $ad = Advertisement::where('id', $fields['advertisement_id'])->first();
        if (!$ad){
            return response([
            'message' => 'No advertisement'
            ], 401);
        }
        if ($ad->user_email != $fields['email']){
            return response([
            'message' => 'Not the owner'
            ], 401);
        }

        $old_pictures = AdvertisementHasPictures::where('advertisement_id', $fields['advertisement_id'])->get();
        if ($old_pictures != NULL){
            foreach ($old_pictures as $i){
                Storage::disk('public')->delete($i->picture);
            }
            AdvertisementHasPictures::where('advertisement_id', $fields['advertisement_id'])->delete();
        }

        $uploadFolder = 'advertisements';
        $image = $request->file('picture');
        $image_uploaded_path = $image->store($uploadFolder, 'public');
        $uploadedImageResponse = [
            "image_name" => basename($image_uploaded_path),
            "image_url" => Storage::disk('public')->url($image_uploaded_path),
            "mime" => $image->getClientMimeType()
        ];
        AdvertisementHasPictures::create([
            'advertisement_id' => $fields['advertisement_id'],
            'picture' => $image_uploaded_path
        ]);

        return response($uploadedImageResponse, 200);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return AdvertisementHasPictures::where('advertisement_id', $id)->get();
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
       $ad = AdvertisementHasPictures::find($id);
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
        return AdvertisementHasPictures::destroy($id);
    }
}
