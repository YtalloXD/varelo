<?php

use App\Http\Controllers\IMerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IMerController::class, 'index']);
Route::post('/imers', [IMerController::class, 'store'])->name('imers.store');
Route::get('/imers/{imer}/edit', [IMerController::class, 'edit']);
Route::put('/imers/{imer}', [IMerController::class, 'update']);
Route::delete('/imers/{imer}', [IMerController::class, 'destroy']);

// Route::resource('/imers', IMerController::class)
    // ->only(['store', 'edit', 'update', 'destroy'])