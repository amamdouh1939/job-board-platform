<?php

use Illuminate\Support\Facades\Route;
use Modules\Company\Http\Controllers\API\V1\Auth\RegistrationController;
use Modules\Company\Http\Controllers\CompanyController;

Route::name('companies')->prefix('v1/companies')->group(function () {
    Route::post('register', [RegistrationController::class, 'register'])->name('register');
});
