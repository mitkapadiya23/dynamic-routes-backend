<?php

use App\Http\Controllers\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// CRUD routes for pages
Route::get('/pages', [PageController::class, 'index']);
Route::post('/pages', [PageController::class, 'store']);
Route::get('/pages/{page}', [PageController::class, 'show']); // Not used for dynamic route

// Dynamic route resolution for nested pages
// Using a route wildcard to catch all nested segments
Route::get('/{segments}', [PageController::class, 'show'])
    ->where('segments', '.*');
