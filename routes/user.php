<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;

Route::get('/logout', [UserController::class, 'logout']);

Route::get('/tickets/{status?}', [TicketController::class, 'index']);
Route::get('/tickets', [TicketController::class, 'index'])->name('tickets');
Route::post('/tickets', [TicketController::class, 'createTicket']);
Route::get('/ticket/{ticket}', [TicketController::class, 'ticketMessages']);
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

Route::get('/orders/{status?}', [OrderController::class, 'ordersPage']);
Route::get('/orders', [OrderController::class, 'ordersPage'])->name('orders');

Route::get('/serviceupdates', [ServiceController::class, 'serviceUpdatesPage']);

Route::get('/addfunds', [FinanceController::class, 'addFundsPage']);
Route::get('/addfunds/history', [FinanceController::class, 'paymentHistoryPage']);
Route::get('/addfunds/{paymentMethod:slug}', [FinanceController::class, 'paymentMethodPage']);
Route::post('/addfunds/{paymentMethod:slug}', [FinanceController::class, 'pay']);

Route::get('/api', [ApiController::class, 'apiPage']);
