<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('/test', function () {
//     return response()->json(['message' => 'Test route works!']);
// });

Route::get('/items', [TaskController::class, 'index']);
Route::post('/items', [TaskController::class, 'store']);
Route::get('/items/{id}', [TaskController::class, 'show']);
Route::put('/items/{id}', [TaskController::class, 'update']);
Route::patch('/items/{id}', [TaskController::class, 'update']);
Route::delete('/items/{id}', [TaskController::class, 'destroy']);