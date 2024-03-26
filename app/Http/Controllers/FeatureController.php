<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeatureController extends Controller
{
    public function store(Request $request)
    {
        $userId = Auth::id();
        $features = $request->input('feature', []);

        foreach ($features as $name => $value) {
            Feature::updateOrCreate(
                ['user_id' => $userId, 'name' => $name],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Features updated successfully.');
    }

    public function show()
    {
        $userId = Auth::id();
        $features = Feature::where('user_id', $userId)->pluck('value', 'name')->toArray();
        //dd($userId, $features);
    
        return view('feature', compact('features'));
    }
    
    public function storeFeatureName(Request $request)
    {
        // Get the user from the session
        $user = Auth::user();
    
        // Iterate through the submitted features
        foreach ($request->input('feature', []) as $key => $value) {
            // Update or create the feature for the user
            Feature::updateOrCreate(
                ['user_id' => $user->id, 'name' => $key],
                ['value' => $value]
            );
        }
    
        // Redirect back with a success message
        return back()->with('success', 'Features updated successfully.');
    }

    public function showFeatures()
    {
        $features = session()->get('features', []);
        
        if (Auth::check()) {
            $user = Auth::user();
        }

        $userId = Auth::id();
        $features = Feature::where('user_id', $userId)->pluck('value', 'name')->toArray();
        
        return view('feature', compact('features'));
    }
    //clear with session()->forget('features');
}
