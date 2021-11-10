<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GoalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Goal/container');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/chat', function () {
    return Inertia::render('Chat/container');
})->name('chat');

Route::middleware('auth:sanctum')->get('/chat/rooms',[ChatController::class,'rooms']);
Route::middleware('auth:sanctum')->get('/chat/room/{roomID}/messages',[ChatController::class,'message']);
Route::middleware('auth:sanctum')->post('/chat/room/{roomID}/message',[ChatController::class,'newMessage']);

Route::middleware('auth:sanctum')->get('/goals', [GoalController::class, 'index']);
Route::middleware('auth:sanctum')->prefix('/goal')->group(function(){
        Route::post('/store',[GoalController::class, 'store']);
        Route::put('/{id}',[GoalController::class, 'update']);
        Route::delete('/{id}',[GoalController::class, 'destroy']);
    }
);

Route::middleware('auth:sanctum')->get('/points', [PointController::class, 'index']);
Route::middleware('auth:sanctum')->put('/points', [PointController::class, 'update']);
