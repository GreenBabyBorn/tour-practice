<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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




// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

/*
 |
 | CRUD операции для туров
 |
*/

Route::get('tours', [TourController::class, 'index']); //
Route::post('tours', [TourController::class, 'store']); //
Route::get('tours/{tour}', [TourController::class, 'show']); //
Route::put('tours/{tour}', [TourController::class, 'update']); //
Route::delete('tours/{id}', [TourController::class, 'destroy']); //

/*
 |
 | CRUD операции для фотографий тура
 |
*/

Route::get('tours/{tour}/photos', [TourPhotoController::class, 'index']); //
Route::post('tours/{tour}/photos', [TourPhotoController::class, 'store']); //
Route::get('tours/{tour}/photos/{tourPhoto}', [TourPhotoController::class, 'show']); // 
Route::put('tours/{tour}/photos/{tourPhoto}', [TourPhotoController::class, 'update']); //
Route::delete('tours/{tour}/photos/{tourPhoto}', [TourPhotoController::class, 'destroy']);//