<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NotesController;
use App\Http\Controllers\Api\NotesTodosController;
use App\Http\Controllers\Api\TodosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['as' => 'api'], function () {
    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
    });

    Orion::resource('notes', NotesController::class);
    Orion::resource('todos', TodosController::class)->except([
        'store',
        'index'
    ]);
    Route::resource('notes/{note}/todos', NotesTodosController::class)->only([
        'index',
        'store'
    ]);
});
