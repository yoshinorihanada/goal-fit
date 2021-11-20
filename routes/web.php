<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\UserController;

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

//rendering home page
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//rendering goal page
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Goal/container');
})->name('dashboard');

//rendering chat page
Route::middleware(['auth:sanctum', 'verified'])->get('/chat', function () {
    return Inertia::render('Chat/container');
})->name('chat');

//chat room routes
Route::middleware('auth:sanctum')->get('/chat/rooms',[ChatController::class,'rooms']);
Route::middleware('auth:sanctum')->get('/chat/room/{roomID}/messages',[ChatController::class,'message']);
Route::middleware('auth:sanctum')->post('/chat/room/{roomID}/message',[ChatController::class,'newMessage']);

//goal routes
Route::middleware('auth:sanctum')->get('/goals', [GoalController::class, 'index']);
Route::middleware('auth:sanctum')->prefix('/goal')->group(function(){
        Route::post('/store',[GoalController::class, 'store']);
        Route::put('/{id}',[GoalController::class, 'update']);
        Route::delete('/{id}',[GoalController::class, 'destroy']);
    }
);

//point routes
Route::middleware('auth:sanctum')->get('/point', [UserController::class, 'showPoint']);
Route::middleware('auth:sanctum')->put('/point', [UserController::class, 'updatePoint']);
