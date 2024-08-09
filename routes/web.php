<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardUser;
use App\Http\Controllers\ProfileController;
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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardUser::class, 'index'])->name('dashboard');
    Route::get('/book', [BookController::class, 'index'])->name('book');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard-admin', [DashboardUser::class, 'index'])->name('dashboard-admin');
    Route::get('/category', [CategoryController::class, 'index'])->name('dashboard-category');
});

require __DIR__.'/auth.php';
