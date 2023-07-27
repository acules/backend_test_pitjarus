<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

// Route::get('/', [LoginController::class, 'index'])->name('index');
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::post('/searchdata', [HomeController::class, 'searchdata'])->name('searchdata');