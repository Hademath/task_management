<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
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




Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
  
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/create_collections', [CollectionController::class, 'store']);
    Route::get('/get_all_collections', [CollectionController::class, 'index']);
    Route::get('/get_collection_by_id/{id}', [CollectionController::class, 'show']);
    Route::put('/edit_collection/{id}', [CollectionController::class, 'update']);
    Route::delete('/delete_collection/{id}', [CollectionController::class, 'destroy']);

    Route::post('/create_task/{collection_id}', [TaskController::class, 'store']);
    Route::put('/edit_task/{collection_id}/{task_id}', [TaskController::class, 'update']);
    Route::get('/get_task_by_id/{collection_id}/{task_id}', [TaskController::class, 'show']);
    Route::delete('/delete_task/{collection_id}/{task_id}', [TaskController::class, 'destroy']);
});