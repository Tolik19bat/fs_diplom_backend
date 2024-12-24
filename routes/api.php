<?php

use App\Http\Controllers\ChairController;
use App\Http\Controllers\HallController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/hall', HallController::class);

// Route::put('/chair', ChairController::class);

Route::put('/hall/prices/{id}', [App\Http\Controllers\HallController::class, 'updatePrices']);

Route::get('/hall/{hallId}/seances', [App\Http\Controllers\HallController::class, 'getSeances']);

Route::put('/hall/{hallId}/sales', [App\Http\Controllers\HallController::class, 'setSales']);

Route::apiResource('/movie', App\Http\Controllers\MovieController::class);