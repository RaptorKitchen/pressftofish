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

    public function startSession(Request $request)
    {
        // Check if the session already has a user ID
        if (!session()->has('user_id')) {
            // Create a new user record in the database
            $user = User::create();
    
            // Store the user's ID in the session
            session()->put('user_id', $user->id);
        }
    
        return redirect()->route('features');
    }
}