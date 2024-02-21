<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Api\V1\User\MeController;

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

Route::prefix('v1')
    ->namespace('\App\Http\Controllers\Api\V1')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::get('/me', User\MeController::class);
    });

Route::prefix('/users')->group(function () {
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}/updateType', [UserController::class, 'edit']);
    Route::post('/{id}/update', [UserController::class, 'update']);
});

Route::get('/group', [GroupController::class, 'index']);
Route::prefix('/group')->group(function () {
    Route::post('/store', [GroupController::class, 'store']);
    Route::post('/{id}/edit', [GroupController::class, 'update']);
    Route::delete('/{id}/delete', [GroupController::class, 'destroy']);
    Route::get('/{id}/show', [GroupController::class, 'show']);
});

Route::prefix('/posts')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::post('/store', [PostController::class, 'store']);
    Route::get('/show/{id}', [PostController::class, 'show']);
    Route::get('/get/{id}', [PostController::class, 'getPost']);
    Route::put('/{id}/update', [PostController::class, 'update']);
    Route::delete('/{id}/delete', [PostController::class, 'destroy']);
    Route::get('/getLike/{id}', [PostController::class, 'getlike']);
    Route::post('/like/{id}', [PostController::class, 'like']);
});

Route::prefix('/courses')->group(function () {
    Route::post('/store', [CourseController::class, 'store']);
    Route::get('/{id}/show', [CourseController::class, 'show']);
});
