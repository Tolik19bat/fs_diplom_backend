<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ChairController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\QrcodeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test-json', function () {
    return response()->json(['message' => 'hello world'], 200, [
        'Content-Type' => 'application/json; charset=utf-8'
    ]);
});

Route::middleware('throttle:limitRequest')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('/tokens/create', function (Request $request) {
        $token = $request->user()->createToken($request->token_name);
        return ['token' => $token->plainTextToken];
    });
});

Route::middleware(['auth:sanctum', 'throttle:limitRequest'])->group(function () {

    Route::get('/hall', [HallController::class, 'index']); // Получить список всех залов (GET /hall)
    Route::post('/hall', [HallController::class, 'store']); // Создать новый зал (POST /hall)
    Route::get('/hall/{hall}', [HallController::class, 'show']); // Получить конкретный зал (GET /hall/{id})
    Route::put('/hall/{hall}', [HallController::class, 'update']); // Обновить зал (PUT /hall/{id})
    Route::delete('/hall/{hall}', [HallController::class, 'destroy']); // Удалить зал (DELETE /hall/{id})

    // Route::apiResource('/hall', HallController::class);
    // Route::apiResource('/movie', MovieController::class);

    Route::get('/movie', [MovieController::class, 'index']); // Вернуть все фильмы
    Route::post('/movie', [MovieController::class, 'store']); // Создать новый фильм
    Route::get('/movie/{movieId}', [MovieController::class, 'show']); // Получить данные о фильме
    Route::put('/movie/{movieId}', [MovieController::class, 'update']); // Обновить фильм
    Route::delete('/movie/{movieId}', [MovieController::class, 'destroy']); // Удалить фильм


    Route::put('/hall/prices/{id}', [HallController::class, 'updatePrices']);
    Route::get('/hall/{hallId}/seances', [HallController::class, 'getSeances']);
    Route::put('/hall/{hallId}/sales', [HallController::class, 'setSales']);
    Route::delete('/seance/all/{movieId}', [SeanceController::class, 'deleteAll']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware('throttle:limitRequest')->group(function () {
    Route::get('/hall/{hallId}/chairs', [HallController::class, 'getChairs']);


    Route::put('/chair', [ChairController::class, 'updateChairs']);


    Route::get('/chair/seance/{seanceId}/date/{date}', [ChairController::class, 'getBySeanceIdAndDate']);

    Route::apiResource('/seance', SeanceController::class);
    Route::apiResource('/chair', ChairController::class);
    Route::get('/hall/{hallId}/seances/{movieId}', [HallController::class, 'getSeances']);
    Route::get('/movie/date/{date}', [MovieController::class, 'getByDate']);
    Route::get('/hall/seances/available', [HallController::class, 'getSeancesAvailable']);
    Route::post('/ticket', [TicketController::class, 'store']);
    Route::post("/qrcode", [QrcodeController::class, 'getQrcode']);
});
