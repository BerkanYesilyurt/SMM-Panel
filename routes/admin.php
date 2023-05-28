<?php

use App\Http\Controllers\admin\AnnouncementController;
use App\Http\Controllers\admin\ApiController;
use App\Http\Controllers\admin\BanController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ErrorController;
use App\Http\Controllers\admin\FaqController;
use App\Http\Controllers\admin\FinanceController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\TicketController;
use App\Http\Controllers\admin\UserController;

Route::get('dashboard', [DashboardController::class, 'dashboardPage']);

Route::get('system-settings', [SettingsController::class, 'systemSettingsPage']);
Route::post('system-settings', [SettingsController::class, 'updateSystemSettings']);

Route::get('users', [UserController::class, 'usersPage']);
Route::post('new-user', [UserController::class, 'createUser']);
Route::post('delete-user', [UserController::class, 'deleteUser']);
Route::get('user/{user}/edit', [UserController::class, 'getUserDetails']);
Route::post('user/{user}/edit', [UserController::class, 'updateUserDetails']);
Route::post('user/{user}/balance-update', [UserController::class, 'updateUserBalance']);

Route::get('services', [ServiceController::class, 'servicesPage']);
Route::post('services', [ServiceController::class, 'updateService']);
Route::post('new-service', [ServiceController::class, 'createNewService']);
Route::post('delete-service', [ServiceController::class, 'deleteService']);

Route::get('servicesupdates', [ServiceController::class, 'serviceUpdatesPage']);
Route::post('servicesupdates', [ServiceController::class, 'updateServiceUpdates']);

Route::get('tickets', [TicketController::class, 'ticketPage']);
Route::get('ticket/{ticket}', [TicketController::class, 'ticketMessages']);
Route::post('ticket/{ticket}', [TicketController::class, 'updateTicketStatus']);
Route::post('ticket_message', [TicketController::class, 'newTicketMessage']);
Route::post('delete-ticket', [TicketController::class, 'deleteTicketAndRelatedMessages']);

Route::get('faq', [FaqController::class, 'faqPage']);
Route::post('faq', [FaqController::class, 'updateFaq']);
Route::post('new-faq', [FaqController::class, 'createNewFaq']);
Route::post('delete-faq', [FaqController::class, 'deleteFaq']);

Route::get('announcements', [AnnouncementController::class, 'announcementsPage']);
Route::post('announcements', [AnnouncementController::class, 'updateAnnouncement']);
Route::post('new-announcement', [AnnouncementController::class, 'createNewAnnouncement']);
Route::post('delete-announcement', [AnnouncementController::class, 'deleteAnnouncement']);

Route::get('categories', [CategoryController::class, 'categoriesPage']);
Route::post('categories', [CategoryController::class, 'updateCategory']);
Route::post('new-category', [CategoryController::class, 'createNewCategory']);
Route::post('delete-category', [CategoryController::class, 'deleteCategory']);

Route::get('orders', [OrderController::class, 'ordersPage']);

Route::get('payment-methods', [FinanceController::class, 'paymentMethodsPage']);
Route::post('payment-methods', [FinanceController::class, 'updatePaymentMethod']);
Route::post('new-payment-method', [FinanceController::class, 'createPaymentMethod']);
Route::post('delete-payment-method', [FinanceController::class, 'deletePaymentMethod']);

Route::get('payment-logs', [FinanceController::class, 'paymentLogsPage']);

Route::get('ban/{user}/{type}', [BanController::class, 'banPage']);
Route::post('ban', [BanController::class, 'ban']);
Route::post('delete-ban', [BanController::class, 'deleteBan']);

Route::get('errors', [ErrorController::class, 'errorLogsPage']);
Route::get('error/{error}', [ErrorController::class, 'errorDetailsPage']);
Route::post('delete-errors', [ErrorController::class, 'deleteErrorLogs']);

Route::get('apis', [ApiController::class, 'apisPage']);
Route::get('api/{api}/edit', [ApiController::class, 'editApiPage']);
Route::post('api', [ApiController::class, 'updateApi']);
Route::get('new-api', [ApiController::class, 'newApiPage']);
Route::post('new-api', [ApiController::class, 'createApi']);
Route::post('delete-api', [ApiController::class, 'deleteApi']);
Route::post('check-api-balance', [ApiController::class, 'checkApiBalance']);
