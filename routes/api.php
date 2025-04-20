<?php

use App\Http\Controllers\API\V1\AccessTokenController;
use Illuminate\Support\Facades\Route;

Route::middleware(['api'])->prefix('v1')->group(function () {
    Route::post('auth/token', [AccessTokenController::class, 'issueToken'])->name('auth.token');
});

