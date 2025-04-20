<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Job\Http\Controllers\API\V1\JobController;

Route::middleware(['api', 'auth:company-api,candidate-api'])->prefix('v1')->group(function () {
    Route::apiResource('jobs', JobController::class);
    Route::post('jobs/{job}/apply', [JobController::class, 'apply'])->withoutMiddleware('auth:company-api')->name('jobs.apply');
});
