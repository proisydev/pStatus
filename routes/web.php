<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::permanentRedirect('/', '/status');
Route::get('/status', [ApiController::class, 'getGlobalStatus']);

# Route::get('/incidents', action: [ApiController::class,'getIncidents']);