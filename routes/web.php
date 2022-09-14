<?php

use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'check'])->middleware('maintenance');

Route::get('/login', [HomeController::class, 'showLogin'])->middleware('guest', 'maintenance')->name('login');
Route::get('/register', [HomeController::class, 'showRegister'])->middleware('guest', 'maintenance')->name('register');

Route::post('/login', [UserController::class, 'login'])->middleware('guest', 'maintenance');
Route::post('/register', [UserController::class, 'register'])->middleware('guest', 'maintenance');

Route::get('/logout', [UserController::class, 'logout'])->middleware('auth', 'maintenance');

Route::get('/tickets', [TicketController::class, 'index'])->middleware('auth', 'maintenance');
Route::post('/tickets', [TicketController::class, 'createTicket'])->middleware('auth', 'maintenance');
Route::get('/ticket/{ticket_id}', [TicketController::class, 'ticketMessages'])->middleware('auth', 'maintenance');
Route::post('/ticket_message', [TicketController::class, 'newTicketMessage'])->middleware('auth', 'maintenance');

Route::get('/faq', [FaqController::class, 'faqPage'])->middleware('auth', 'maintenance');
Route::post('/faq', [FaqController::class, 'createFaq'])->middleware('auth', 'maintenance');

Route::get('/profile', [ProfileController::class, 'profilePage'])->middleware('auth', 'maintenance');
Route::post('/profile', [ProfileController::class, 'updateProfile'])->middleware('auth', 'maintenance');

Route::get('/generate', [ProfileController::class, 'generateToken'])->middleware('auth', 'maintenance');

Route::get('/services', [ServiceController::class, 'servicesPage'])->middleware('auth', 'maintenance');
