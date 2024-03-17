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
        $featureName = $request->input('feature_name');
        $featureId = $request->input('feature_id');
    
        // Store the feature name in the session
        session()->put("features.$featureId", $featureName);
    
        return back()->with('success', 'Feature name saved successfully.');
    }

    public function showFeatures()
    {
        $features = session()->get('features', []);
    
        return view('feature', compact('features'));
    }
    //clear with session()->forget('features');
}
