<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelRanksController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('total', [LevelRanksController::class, 'total']);
Route::get('points', [LevelRanksController::class, 'points']);
Route::get('deaths', [LevelRanksController::class, 'deaths']);
Route::get('hs', [LevelRanksController::class, 'hs']);
Route::get('kills', [LevelRanksController::class, 'kills']);
Route::get('knifes', [LevelRanksController::class, 'knifes']);

Route::get('get/{id}', [LevelRanksController::class, 'getPoints']);
Route::get('user/{id}', [LevelRanksController::class, 'getUser']);