<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Advertisement;
use App\Models\AdvertisementHasPictures;
class PicturesController extends Controller
{
    public function uploadProfilePicture(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'image' => 'required|image:jpeg,png,jpg,svg|max:2048'
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
        $image = $request->file('image');
        $image_uploaded_path = $image->store($uploadFolder, 'public');
        $uploadedImageResponse = [
            "image_name" => basename($image_uploaded_path),
            "image_url" => Storage::disk('public')->url($image_uploaded_path),
            "mime" => $image->getClientMimeType()
        ];

        $user->update(['picture' => $image_uploaded_path]);
        return response($uploadedImageResponse, 200);
    }

    public function uploadAdvertisementPictures(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'advertisement_id' => 'required|integer',
            'image' => 'required|image:jpeg,png,jpg,svg|max:2048'
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
        $image = $request->file('image');
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
}
