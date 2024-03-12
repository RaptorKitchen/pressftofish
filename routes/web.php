<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\MirrorController; 
use App\Http\Controllers\ProfileController;
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
});

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

Route::get('/feature', [FeatureController::class, 'show'])->name('survey-area');

Route::post('/feature/store', [FeatureController::class, 'store'])->name('feature.store');

Route::get('/fish', function () {
    return view('fishing');
})->name('fishing');

Route::get('/mirror', [MirrorController::class, 'index'])->name('mirror');

Route::post('/save-profile-image', [UserController::class, 'saveProfileImage'])->name('saveProfileImage');

Route::get('/survey', function () {
    return view('survey');
})->name('survey-area');

Route::get('/speed-fishing', function () {
    return view('speed-fishing');
})->name('speed-fishing');

require __DIR__.'/auth.php';
