<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\PaisesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/token', [TokenController::class, 'index']);
Route::get('/paises', [PaisesController::class, 'index']);
Route::get('/logs', [LogsController::class, 'index']);