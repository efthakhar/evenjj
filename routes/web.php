<?php

use App\Http\Controllers\Admin\Dashboard\DashboardController;
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

});
