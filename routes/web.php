<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\AdminController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;


Route::get('login', [LoginController::class, 'login'])->name('admin.login');
Route::post('auth', [LoginController::class, 'auth' ])->name('admin.auth');

Route::name('admin.')->middleware(['admin_auth'])->prefix('admin')->group(function (Router $router) {
    $router->get('', [AdminController::class, 'index'])->name('dashboard');

    $router->resource('category', CategoryController::class);
    $router->resource('brand', BrandController::class);
});

Route::group(['prefix' => '{lang}'], function (Router $router) {

});
