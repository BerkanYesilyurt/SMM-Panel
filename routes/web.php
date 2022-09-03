<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'check']);

Route::get('/login', [HomeController::class, 'showLogin'])->name('login');
Route::get('/register', [HomeController::class, 'showRegister'])->name('register');

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::get('/logout', [UserController::class, 'logout']);

Route::get('/tickets', [TicketController::class, 'index']);
Route::post('/tickets', [TicketController::class, 'createTicket']);
Route::get('/ticket/{ticket_id}', [TicketController::class, 'ticketMessages']);
Route::post('/ticket_message', [TicketController::class, 'newTicketMessages']);
