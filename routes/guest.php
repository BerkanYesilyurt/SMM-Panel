<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'check'])->middleware('verifypanelinstalled', 'maintenance');
Route::get('/install', [InstallController::class, 'installPage'])->name('install');

Route::middleware(['guest', 'maintenance', 'verifypanelinstalled'])->group(function () {
    Route::get('/login', [HomeController::class, 'showLogin'])->name('login');
    Route::get('/register', [HomeController::class, 'showRegister'])->name('register');

    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
});
