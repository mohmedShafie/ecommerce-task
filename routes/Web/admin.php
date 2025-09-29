<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;

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

Route::get('/login', [AdminController::class, 'showFormLogin'])->name('admin.show.formLogin');
Route::post('/login', [AdminController::class, 'login'])->name('admin.login');

Route::middleware(['admin', 'web'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

    // Categories routes
    Route::resource('/categories', CategoryController::class)->except(['show']);
    Route::post('/categories/{id}/change-status', [CategoryController::class, 'changeStatus'])->name('categories.changeStatus');

    // Banners routes
    Route::resource('banners', BannerController::class)->except(['show']);
    Route::post('banners/{id}/change-status', [BannerController::class, 'changeStatus'])->name('banners.changeStatus');
});
