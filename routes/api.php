<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\RolesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/contacts')->group(function() {
    Route::resource('/', ContactsController::class);
    Route::post('/{id}/toggle-favorite', [ContactsController::class, 'toggle_favorite']);
});

Route::prefix('/call-logs')->group(function() {
    Route::get('/', [ContactsController::class, 'call_logs_list']);
    Route::post('/', [ContactsController::class, 'add_call_log']);
});

Route::prefix('/roles')->group(function() {
    Route::get('/', [RolesController::class, 'index']);
});
