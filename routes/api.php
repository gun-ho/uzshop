<?php

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('products',          [ProductController::class, 'index'])->name('product.list');
Route::get('product/{product}', [ProductController::class, 'show'])->name('product.show');

Route::get('product/{product}/reviews', [ReviewController::class, 'index'])->name('review.list');

Route::get('brands', [BrandController::class, 'index']);

Route::middleware('auth:api')->get('/user', function (Request $request) {



    return $request->user();
});


