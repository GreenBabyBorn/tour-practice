<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TourPhotoController;


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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
	return $request->user();
});

Route::middleware(['auth:sanctum'])->get('/users', [UserController::class, 'index']);
Route::middleware(['auth:sanctum'])->get('/users/{user}', [UserController::class, 'show']);
Route::middleware(['auth:sanctum'])->put('/users/{user}', [UserController::class, 'update']);


Route::get('/reviews', [ReviewController::class, 'index']);
Route::get('/reviews/{review}', [ReviewController::class, 'show']);
Route::put('/reviews/{review}', [ReviewController::class, 'update'])->middleware(['auth:sanctum']);
Route::post('/reviews', [ReviewController::class, 'store'])->middleware(['auth:sanctum']);
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->middleware(['auth:sanctum']);

Route::get('/tours', [TourController::class, 'index']);
Route::get('/tours/{tour}', [TourController::class, 'show']);
Route::post('/tours', [TourController::class, 'store'])->middleware(['auth:sanctum']);
Route::post('/tours/{tour}/photos', [TourPhotoController::class, 'store'])->middleware(['auth:sanctum']);
Route::delete('/tours/{tour}', [TourController::class, 'destroy'])->middleware(['auth:sanctum', 'admin']);