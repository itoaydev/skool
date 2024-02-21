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
Route::put('/update/{id}', [UserController::class, 'edit']);
Route::post('/userProfile/{id}', [UserController::class, 'update']);
Route::get('/user/{id}', [UserController::class, 'show']);
// Route::get('/users', [UserController::class, 'index']);

Route::get('/group', [GroupController::class, 'index']);
Route::prefix('/group')->group(function () {
    Route::post('/store', [GroupController::class, 'store']);
    Route::post('/{id}/edit', [GroupController::class, 'update']);
    Route::delete('/{id}/delete', [GroupController::class, 'destroy']);
    Route::get('/{id}/show', [GroupController::class, 'show']);
});
Route::post('/groups/{groupId}/join', [GroupController::class, 'joinGroup']);

// Route::post('/posts', [PostController::class, 'store']);
// Route::get('/showPost/{id}', [PostController::class, 'show']);
// Route::get('/getPost/{id}', [PostController::class, 'getPost']);
// Route::put('/post/{id}/update', [PostController::class, 'update']);
// Route::delete('/post/{id}/delete', [PostController::class, 'destroy']);
// Route::get('getLike/{id}', [PostController::class, 'getlike']);
// Route::post('like/{id}', [PostController::class, 'like']);

Route::prefix('/posts')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::post('/store', [PostController::class, 'store']);
    Route::get('/show/{id}', [PostController::class, 'show']);
    Route::get('/get/{id}', [PostController::class, 'getPost']);
    Route::put('/{id}/update', [PostController::class, 'update']);
    Route::delete('/{id}/delete', [PostController::class, 'destroy']);
    Route::get('/getLike/{id}', [PostController::class, 'getlike']);
    Route::post('/like/{id}', [PostController::class, 'like']);
});

Route::post('/course', [CourseController::class, 'store']);
Route::get('/getCourse/{id}', [CourseController::class, 'show']);
