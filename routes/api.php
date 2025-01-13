<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChairController;
use App\Http\Controllers\HallController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
    return ['token' => $token->plainTextToken];
});

Route::middleware('throttle:limitRequest')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware(['auth:sanctum', 'throttle:limitRequest'])->group(function () {
    Route::apiResource('/hall', HallController::class);
    Route::put('/chair', [ChairController::class, 'updateChairs']);
    Route::put('/hall/prices/{id}', [App\Http\Controllers\HallController::class, 'updatePrices']);
    Route::get('/hall/{hallId}/seances', [App\Http\Controllers\HallController::class, 'getSeances']);
    Route::put('/hall/{hallId}/sales', [App\Http\Controllers\HallController::class, 'setSales']);
    Route::apiResource('/movie', App\Http\Controllers\MovieController::class);

    Route::get('/logout', [AuthController::class, 'logout']);
});
