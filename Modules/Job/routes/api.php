<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Job\Http\Controllers\API\V1\JobController;

Route::middleware(['api', 'auth:company-api,candidate-api'])->prefix('v1')->group(function () {
    Route::get('test', function (Request $request) {
        dd(auth()->user());
    });
    Route::apiResource('jobs', JobController::class);
});
