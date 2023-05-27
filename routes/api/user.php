<?php

use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});
