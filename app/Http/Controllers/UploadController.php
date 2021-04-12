<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UploadController extends Controller
{
    public function uploadProfilePicture(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|string',
            'image' => 'required|image:jpeg,png,jpg,svg|max:2048'
        ]);

        $user = User::where('email', $validator['email'])->first();
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
}
