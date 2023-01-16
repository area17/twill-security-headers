<?php

use A17\TwillSecurityHeaders\Support\Facades\Route;

// @phpstan-ignore-next-line
Route::name('twillSecurityHeaders.redirectToEdit')->get('/twillSecurityHeaders/redirectToEdit', [
    \A17\TwillSecurityHeaders\Http\Controllers\TwillSecurityHeaderController::class,
    'redirectToEdit',
]);

// @phpstan-ignore-next-line
Route::module('twillSecurityHeaders');
