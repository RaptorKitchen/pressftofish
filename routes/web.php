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

Route::get('/', function () {
    return view('welcome');
})->name('start');

Route::post('/', function (Request $request) {

    if ($request->session()->exists('user_id')) {
        // Session exists, redirect to the cabin
        return redirect('/cabin');
    } else {
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

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/about-me', function () {
    return view('about-me');
})->name('about_me');

Route::get('/ajax/{route}', [AjaxController::class, 'handleRequest']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/cabin', function () {
    return view('cabin');
})->name('cabin');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

require __DIR__.'/auth.php';
