<?php

use Illuminate\Support\Facades\Route;
use Modules\Candidate\Http\Controllers\API\V1\Auth\RegistrationController;
use Modules\Candidate\Http\Controllers\API\V1\DashboardController;


Route::name('candidates')->prefix('v1/candidates')->group(function () {
    Route::post('register', [RegistrationController::class, 'register'])->name('register');
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->middleware(['api', 'auth:candidate-api']);
});
