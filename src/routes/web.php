<?php

use Illuminate\Support\Facades\Route;
use Gigabait\Sso\Http\Controllers\SsoController;

Route::middleware(['web'])->group(function () {
    Route::get('/sso-login', [SsoController::class, 'login'])->name('sso-login');
});
