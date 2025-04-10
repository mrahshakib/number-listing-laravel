<?php

use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StoreController::class, "index"])->name('index');
Route::post('/', [StoreController::class, "store"])->name('index.store');
Route::get('edit/{id}', [StoreController::class, "edit"])->name('edit');
Route::post('edit/{id}', [StoreController::class, "update"])->name('edit.store');
Route::get('delete/{id}', [StoreController::class, "destroy"])->name('delete');
