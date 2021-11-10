<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\PointController;
use Inertia\Inertia;
use App\Http\Controllers\ChatController;
use Illuminate\Foundation\Application;

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

// Route::middleware('auth:sanctum')->get('/goals', [GoalController::class, 'index']);
// Route::middleware('auth:sanctum')->prefix('/goal')->group(function(){
//         Route::post('/store',[GoalController::class, 'store']);
//         Route::put('/{id}',[GoalController::class, 'update']);
//         Route::delete('/{id}',[GoalController::class, 'destroy']);
//     }
// );

// Route::middleware('auth:sanctum')->get('/points', [PointController::class, 'index']);
// Route::middleware('auth:sanctum')->put('/points', [PointController::class, 'update']);
