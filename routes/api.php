<?php

use App\Http\Controllers\Hotels\HotelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('hotels')->group(function() {
    Route::get('/list', [HotelController::class, 'index'])->name('hotels.list');
    Route::post('/store', [HotelController::class, 'store'])->name('hotels.store');
    Route::get('/show/{id}', [HotelController::class, 'show'])->name('hotels.show');
    Route::put('/update/{id}', [HotelController::class, 'update'])->name('hotels.update');
    Route::delete('/destroy/{id}', [HotelController::class, 'destroy'])->name('hotels.destroy');
    Route::post('/assign', [HotelController::class, 'assign'])->name('hotels.assign');
    Route::get('/cities', [HotelController::class, 'cities'])->name('hotels.cities');
    Route::get('/room-types', [HotelController::class, 'roomTypes'])->name('hotels.room.types');
    Route::get('/accommodation-types/{roomTypeId}', [HotelController::class, 'accommodationTypes'])->name('hotels.accommodation.types');
});

