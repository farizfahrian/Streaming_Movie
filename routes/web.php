<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Http;
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


// Rute untuk registrasi pengguna (user)
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/create', [DashboardController::class, 'create'])->name('admin.create');
        Route::post('/store', [DashboardController::class, 'store'])->name('admin.store');
        Route::delete('/delete/{id}', [DashboardController::class, 'delete'])->name('admin.delete');
        Route::get('/edit/{id}', [DashboardController::class, 'edit'])->name('admin.edit');
        Route::put('/update/{id}', [DashboardController::class, 'update'])->name('admin.update');
        Route::get('/show/{id}', [DashboardController::class, 'show'])->name('admin.show');
    });

Auth::routes(['verify' => true]);
