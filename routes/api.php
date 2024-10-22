<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

// Main condition
Route::get('/cities-main/{uf}', function ($uf) {
    $path = config('app.main_api_ibge') . $uf;
    return Http::get($path);
});

// Alternative condition
Route::get('/cities-alternative/{uf}', function ($uf) {
    $path = config('app.alternative_api_ibge') . $uf;
    return Http::get($path);
});
