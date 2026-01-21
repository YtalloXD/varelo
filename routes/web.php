<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\IMerController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/', [IMerController::class, 'index']);
    Route::post('/imers', [IMerController::class, 'store'])->name('imers.store');
    Route::get('/imers/{imer}/edit', [IMerController::class, 'edit']);
    Route::put('/imers/{imer}', [IMerController::class, 'update']);
    Route::delete('/imers/{imer}', [IMerController::class, 'destroy']);
});

// Route::resource('/imers', IMerController::class)
    // ->only(['store', 'edit', 'update', 'destroy'])

// REGISTER ROUTES
Route::view('/register', 'auth.register')
    ->middleware('guest')
    ->name('register');
Route::post('/register', Register::class)
    ->middleware('guest');

// LOGIN ROUTES
Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');
Route::post('/login', Login::class)
    ->middleware('guest');


// LOGOUT ROUTES
Route::post('/logout', Logout::class)
    ->middleware('auth');

