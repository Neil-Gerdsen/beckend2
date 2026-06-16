<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZettenController;


Route::get('/', function () {
    $users = User::select('id', 'name')->get();
    return view('welcome', compact('users'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/zetten', [ZettenController::class, 'index']);
// Route::post('/zetten', [ZettenController::class, 'create'])->name('zetten.create');
// Route::get('/game/{id}', [ZettenController::class, 'show'])->name('game.show');
// Route::get('/game/{id}', [ZettenController::class, 'create'])->name('game.create');

Route::resource('game', ZettenController::class)
    ->only([
        'index',
        'create',
        'store',
        'show',
    ]);
Route::post('/game/{game}/zetten', [ZettenController::class, 'storeZet'])->name('game.zetten');
require __DIR__.'/auth.php';
