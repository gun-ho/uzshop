<?php

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

Route::get('test', function () {
    $data = [
        "status" => "200",
        "message" => "Чо там Шер"
    ];

    return response()->json($data);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {



    return $request->user();
});


