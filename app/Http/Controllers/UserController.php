<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function saveProfileImage(Request $request)
    {
        // Decode the image data
        $imageData = $request->image;
        list($type, $imageData) = explode(';', $imageData);
        list(, $imageData)      = explode(',', $imageData);
        $imageData = base64_decode($imageData);

        // Generate a unique filename
        $filename = Auth::id() . '_' . time() . '_' . Str::random(10) . '.jpg';

        // Save the image to the public/images/profile_images directory
        file_put_contents(public_path('images/profile_images/' . $filename), $imageData);

        // Update the user's profile_image field in the database
        $user = Auth::user();
        $user->profile_image = $filename;
        $user->save();

        return response()->json(['success' => true]);
    }
}