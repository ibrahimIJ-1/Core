<?php

use App\Http\Controllers\Auth\APIAuthenticatedSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [APIAuthenticatedSessionController::class, 'store']);
Route::post('logout', [APIAuthenticatedSessionController::class, 'destroy']);