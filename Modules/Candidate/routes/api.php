<?php

use Illuminate\Support\Facades\Route;
use Modules\Candidate\Http\Controllers\API\V1\Auth\RegistrationController;


Route::name('candidates')->prefix('v1/candidates')->group(function () {
    Route::post('register', [RegistrationController::class, 'register'])->name('register');
});
