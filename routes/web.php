<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\SettingsController;
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

Route::middleware(['guest', 'maintenance', 'verifypanelinstalled'])->group(function () {
    Route::get('/login', [HomeController::class, 'showLogin'])->name('login');
    Route::get('/register', [HomeController::class, 'showRegister'])->name('register');

    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
});

Route::middleware(['auth', 'maintenance', 'verifypanelinstalled', 'isaccountbanned'])->group(function () {
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

    Route::get('/serviceupdates', [ServiceController::class, 'serviceUpdatesPage']);

    Route::get('/api', [ApiController::class, 'apiPage']);
});

Route::middleware(['auth', 'isadmin', 'verifypanelinstalled'])->prefix('/admin/')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboardPage']);

    Route::get('system-settings', [SettingsController::class, 'systemSettingsPage']);
    Route::post('system-settings', [SettingsController::class, 'updateSystemSettings']);

    Route::get('users', [\App\Http\Controllers\admin\UserController::class, 'usersPage']);

    Route::get('user/{user}/edit', [\App\Http\Controllers\admin\UserController::class, 'getUserDetails']);
    Route::post('user/{user}/edit', [\App\Http\Controllers\admin\UserController::class, 'updateUserDetails']);

    Route::post('user/{user}/balance-update', [\App\Http\Controllers\admin\UserController::class, 'updateUserBalance']);

    Route::get('services', [\App\Http\Controllers\admin\ServiceController::class, 'servicesPage']);
    Route::post('services', [\App\Http\Controllers\admin\ServiceController::class, 'updateService']);
    Route::post('new-service', [\App\Http\Controllers\admin\ServiceController::class, 'createNewService']);
    Route::post('delete-service', [\App\Http\Controllers\admin\ServiceController::class, 'deleteService']);

    Route::get('servicesupdates', [\App\Http\Controllers\admin\ServiceController::class, 'serviceUpdatesPage']);
    Route::post('servicesupdates', [\App\Http\Controllers\admin\ServiceController::class, 'updateServiceUpdates']);

    Route::get('tickets', [\App\Http\Controllers\admin\TicketController::class, 'ticketPage']);
    Route::get('ticket/{ticket}', [\App\Http\Controllers\admin\TicketController::class, 'ticketMessages']);
    Route::post('ticket_message', [\App\Http\Controllers\admin\TicketController::class, 'newTicketMessage']);

    Route::get('faq', [\App\Http\Controllers\admin\FaqController::class, 'faqPage']);
    Route::post('faq', [\App\Http\Controllers\admin\FaqController::class, 'updateFaq']);
    Route::post('new-faq', [\App\Http\Controllers\admin\FaqController::class, 'createNewFaq']);
    Route::post('delete-faq', [\App\Http\Controllers\admin\FaqController::class, 'deleteFaq']);

    Route::get('announcements', [\App\Http\Controllers\admin\AnnouncementController::class, 'announcementsPage']);
    Route::post('announcements', [\App\Http\Controllers\admin\AnnouncementController::class, 'updateAnnouncement']);
    Route::post('new-announcement', [\App\Http\Controllers\admin\AnnouncementController::class, 'createNewAnnouncement']);
    Route::post('delete-announcement', [\App\Http\Controllers\admin\AnnouncementController::class, 'deleteAnnouncement']);

    Route::get('categories', [\App\Http\Controllers\admin\CategoryController::class, 'categoriesPage']);
    Route::post('categories', [\App\Http\Controllers\admin\CategoryController::class, 'updateCategory']);
    Route::post('new-category', [\App\Http\Controllers\admin\CategoryController::class, 'createNewCategory']);
    Route::post('delete-category', [\App\Http\Controllers\admin\CategoryController::class, 'deleteCategory']);

    Route::get('orders', [\App\Http\Controllers\admin\OrderController::class, 'ordersPage']);
});
