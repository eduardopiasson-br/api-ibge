<?php

use App\Http\Controllers\CitiesController;
use Illuminate\Support\Facades\Route;

Route::get('/cities/brasilapi/{uf}', [CitiesController::class, 'getCitiesFromBrasilApi']);
Route::get('/cities/ibgeapi/{uf}', [CitiesController::class, 'getCitiesFromIbgeApi']);
