<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('nodes', \App\Http\Controllers\NodeController::class);
