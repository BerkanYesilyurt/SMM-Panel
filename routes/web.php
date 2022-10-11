<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\OrderController;
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

Route::get('/', [HomeController::class, 'check'])->middleware('verifypanelinstalled', 'maintenance');
Route::get('/install', [InstallController::class, 'installPage'])->name('install');

Route::middleware(['guest', 'maintenance'])->group(function () {
Route::get('/login', [HomeController::class, 'showLogin'])->name('login');
Route::get('/register', [HomeController::class, 'showRegister'])->name('register');

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
});

Route::middleware(['auth', 'maintenance', 'verifypanelinstalled'])->group(function () {
Route::get('/logout', [UserController::class, 'logout']);

Route::get('/tickets', [TicketController::class, 'index']);
Route::post('/tickets', [TicketController::class, 'createTicket']);
Route::get('/ticket/{ticket_id}', [TicketController::class, 'ticketMessages']);
Route::post('/ticket_message', [TicketController::class, 'newTicketMessage']);

Route::get('/faq', [FaqController::class, 'faqPage']);
Route::post('/faq', [FaqController::class, 'createFaq']);

Route::get('/profile', [ProfileController::class, 'profilePage']);
Route::post('/profile', [ProfileController::class, 'updateProfile']);

Route::get('/generate', [ProfileController::class, 'generateToken']);

Route::get('/services', [ServiceController::class, 'servicesPage']);

Route::get('/new-order', [OrderController::class, 'orderPage'])->name('new-order');
Route::post('/new-order', [OrderController::class, 'createNewOrder']);

Route::get('/massorders', [OrderController::class, 'massOrderPage']);

Route::get('/orders', [OrderController::class, 'ordersPage']);

Route::get('/serviceupdates', [ServiceController::class, 'servicesUpdatesPage']);

Route::get('/api', [ApiController::class, 'apiPage']);
});
