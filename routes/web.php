<?php

use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Event\EventController;
use App\Http\Controllers\Admin\EventCategory\EventCategoryController;
use App\Http\Controllers\Auth\AuthController;
use Database\Seeders\DevDemo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// create demo site
Route::get('/demo', function (Request $reqest) {

    $seeder = new DevDemo();
    $seeder->run();

    return redirect('/login');
});

// Authentication Routes
Route::get('/register', [AuthController::class, 'showUserRegistrationPage'])->name('showUserRegistrationPage');
Route::post('/register', [AuthController::class, 'registerUser'])->name('registerUser');
Route::get('/login', [AuthController::class, 'showloginPage'])->name('showloginPage');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes:
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/admin', [DashboardController::class, 'overview']);

    // Event Category
    Route::get('/admin/event-categories', [EventCategoryController::class, 'index'])->name('admin.event_category.index');
    Route::get('/admin/event-categories/list', [EventCategoryController::class, 'list'])->name('admin.event_category.list');
    Route::get('/admin/event-categories/create', [EventCategoryController::class, 'create'])->name('admin.event_category.create');
    Route::get('/admin/event-categories/{id}', [EventCategoryController::class, 'show'])->name('admin.event_category.single');
    Route::post('/admin/event-categories', [EventCategoryController::class, 'store'])->name('admin.event_category.store');
    Route::get('/admin/event-categories/{id}/edit', [EventCategoryController::class, 'edit'])->name('admin.event_category.edit');
    Route::put('/admin/event-categories/{id}', [EventCategoryController::class, 'update'])->name('admin.event_category.update');
    Route::delete('/admin/event-categories/{id}', [EventCategoryController::class, 'delete'])->name('admin.event_category.delete');

    // Event
    Route::get('/admin/events', [EventController::class, 'index'])->name('admin.event.index');
    Route::get('/admin/events/create', [EventController::class, 'create'])->name('admin.event.create');
    Route::get('/admin/events/{id}', [EventController::class, 'show'])->name('admin.event.single');
    Route::post('/admin/events', [EventController::class, 'store'])->name('admin.event.store');
    Route::get('/admin/events/{id}/edit', [EventController::class, 'edit'])->name('admin.event.edit');
    Route::put('/admin/events/{id}', [EventController::class, 'update'])->name('admin.event.update');
    Route::delete('/admin/events/{id}', [EventController::class, 'delete'])->name('admin.event.delete');

});
