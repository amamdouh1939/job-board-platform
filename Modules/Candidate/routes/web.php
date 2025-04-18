<?php

use Illuminate\Support\Facades\Route;
use Modules\Candidate\Http\Controllers\CandidateController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('candidate', CandidateController::class)->names('candidate');
});
