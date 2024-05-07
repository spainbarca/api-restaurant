<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/** PERSONAL API TOKENS WITH SANCTUM! */
Route::get('/test', function(){
    return [
        "name" => "Noah",
        "age" => 24,
        "country" => "Peru"
    ];
});

Route::middleware('auth:sanctum')->post('orders', function() {
    abort_unless(Auth::user()->tokenCan('orders:create'), 403, "You don't have permissions to perform this action");

    return [
        'message' => 'Order created',
    ];
});

//Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function ()
{
    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        //return $request->user();
        return Auth::user();
    });
});
