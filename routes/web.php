<?php

use App\Http\Controllers\ServerController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('servers/status/{id}', [ServerController::class, 'getLiveStatus'])->name('servers.liveStatus');
    // Route::resource('servers', ServerController::class);
    Route::get('servers/trashed', [ServerController::class, 'trashed'])->name('servers.trashed');
    Route::post('servers/restore/{id}', [ServerController::class, 'restore'])->name('servers.restore');
    Route::resource('servers', ServerController::class)->except(['show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
