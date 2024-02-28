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

Route::get('/ajax/{route}', [AjaxController::class, 'handleRequest']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/feature', [FeatureController::class, 'show'])->name('survey-area');

Route::post('/feature/store', [FeatureController::class, 'store'])->name('feature.store');

Route::get('/fish', function () {
    return view('fishing');
})->name('fishing');

Route::get('/mirror', [MirrorController::class, 'index'])->name('mirror');

Route::get('/survey', function () {
    return view('survey');
})->name('survey-area');

require __DIR__.'/auth.php';
