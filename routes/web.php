<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'login'])->name('admin.login');
Route::post('auth', [LoginController::class, 'auth' ])->name('admin.auth');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('', [AdminController::class, 'index']);
});
