<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\MirrorController; 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (Request $request) {
    // Check if a user is already in the session
    if (!$request->session()->has('user_id')) {
        // Create a new user
        $user = User::create([
            'name' => 'Guest',
            'email' => 'guest' . rand(1000, 9999) . '@pressftofish.io',
            'password' => bcrypt('secret')
        ]);

        // Store user ID in the session
        $request->session()->put('user_id', $user->id);

        // Authenticate the user
        Auth::login($user);
    }

    return view('splash');
})->name('splash');

Route::get('/start', function (Request $request) {
    return view('welcome');
})->name('start');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/about-me', function () {
    return view('about-me');
})->name('about_me');

Route::get('/ajax/{route}/{caveStatus?}', [AjaxController::class, 'handleRequest']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('web')->group(function () {
    Route::post('/', function (Request $request) {

        if ($request->session()->exists('user_id')) {
            // Create a new user
            $user = User::create([
                'name' => 'Guest',
                'email' => 'guest' . rand(1000, 9999) . '@pressftofish.io',
                'password' => bcrypt('secret')
            ]);
        
            // Store user ID in the session
            $request->session()->put('user_id', $user->id);
        
            // Authenticate the user
            Auth::login($user);
            // Session exists, redirect to the cabin
            return redirect('/cabin');
        } else {
            dd('session no exists');
            // Create a new user or retrieve an existing one
            $user = User::firstOrCreate([
                'name' => 'Guest',
                'email' => 'guest' . rand(1000, 9999) . '@pressftofish.io',
                'password' => bcrypt('secret')
            ]);
    
            // Store user ID in the session
            $request->session()->put('user_id', $user->id);
    
            // Authenticate the user
            Auth::login($user);
    
            // Redirect to the cabin
            return redirect('/cabin');
        }
    })->name('start');

    Route::get('/cabin', function () {
        return view('cabin');
    })->name('cabin');

    Route::get('/cave/{caveStatus?}', function ($caveStatus = null) {
        return view('cave', ['caveStatus' => $caveStatus]);
    })->name('cave');  
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/get-random-fish', [AjaxController::class, 'getRandomFish'])->name('get-random-fish');

    Route::get('/strange-glow', function () {
        return view('strange-glow');
    })->name('strange-glow');

    Route::get('/survey', [FeatureController::class, 'showFeatures'])->name('survey-area');

    Route::post('/survey/store', [FeatureController::class, 'storeFeatureName'])->name('feature.store');

    Route::get('/fish', function () {
        return view('fishing');
    })->name('fishing');
    
    Route::get('/mirror', [MirrorController::class, 'index'])->name('mirror');
    
    Route::post('/save-profile-image', [UserController::class, 'saveProfileImage'])->name('saveProfileImage');
    
    Route::get('/speed-fishing', function () {
        return view('speed-fishing');
    })->name('speed-fishing');
    
    Route::get('/last-known', function() {
        if (Auth::check()) {
            return redirect()->route($user->getLastKnown());
        } else {
            return redirect()->route('start');
        }
    })->name('last_known');
    
    //questions 
    Route::get('/get-question', [QuestionController::class, 'getQuestion'])->name('get-question');
    Route::post('/submit-answer', [QuestionController::class, 'submitAnswer'])->name('submit-answer');
});


require __DIR__.'/auth.php';
