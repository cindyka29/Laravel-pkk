<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\absensiController;
use App\Http\Controllers\iuranController;
use App\Http\Controllers\kalenderController;
use App\Http\Controllers\anggotaController;
use App\Http\Controllers\kasumumController;
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
Route::post('/absens/{nama}', [absensiController::class, 'update']);
Route::get('/iurans/{nama}', [iuranController::class, 'update']);
Route::get('/kalenders/{title}', [kalenderController::class, 'update']);
Route::delete('/kalenders/{title}', [KalenderController::class, 'destroy']);
Route::get('/anggotas/{nama}', [anggotaController::class, 'update']);
Route::get('/kasumums/{id}', [kasumumController::class, 'update']);
// Route::delete('/api/absens/{nama}', [absensiController::class, 'destroy']);

Route::resource('/absens', absensiController::class);
Route::resource('/iurans', iuranController::class);
Route::resource('/kalenders', kalenderController::class);
Route::resource('/anggotas', anggotaController::class);
Route::resource('/kasumums', kasumumController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
