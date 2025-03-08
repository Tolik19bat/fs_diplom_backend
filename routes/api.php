<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('throttle:limitRequest')->group(function () {
    Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/tokens/create', function (Request $request) {
        $token = $request->user()->createToken($request->token_name);
        return ['token' => $token->plainTextToken];
    });
});

Route::middleware(['auth:sanctum', 'throttle:limitRequest'])->group(function () {
    Route::apiResource('/hall', App\Http\Controllers\HallController::class);
    Route::put('/chair', [App\Http\Controllers\ChairController::class, 'updateChairs']);
    Route::put('/hall/prices/{id}', [App\Http\Controllers\HallController::class, 'updatePrices']);
    Route::get('/hall/{hallId}/seances', [App\Http\Controllers\HallController::class, 'getSeances']);
    Route::put('/hall/{hallId}/sales', [App\Http\Controllers\HallController::class, 'setSales']);
    Route::apiResource('/movie', App\Http\Controllers\MovieController::class);
    Route::delete('/seance/all/{movieId}', [App\Http\Controllers\SeanceController::class, 'deleteAll']);
    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
});

Route::middleware('throttle:limitRequest')->group(function () {
    Route::get('/hall/{hallId}/chairs', [App\Http\Controllers\HallController::class, 'getChairs']);

    Route::get('/chair/seance/{seanceId}/date/{date}', [App\Http\Controllers\ChairController::class, 'getBySeanceIdAndDate']);

    Route::apiResource('/seance', App\Http\Controllers\SeanceController::class);
    Route::apiResource('/chair', App\Http\Controllers\ChairController::class);
    Route::get('/hall/{hallId}/seances/{movieId}', [App\Http\Controllers\HallController::class, 'getSeances']);
    Route::get('/movie/date/{date}', [App\Http\Controllers\MovieController::class, 'getByDate']);
    Route::get('/hall/seances/available', [App\Http\Controllers\HallController::class, 'getSeancesAvailable']);
    Route::post('/ticket', [App\Http\Controllers\TicketController::class, 'store']);
    Route::post("/qrcode", [App\Http\Controllers\QrcodeController::class, 'getQrcode']);
});
