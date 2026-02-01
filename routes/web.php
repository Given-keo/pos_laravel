<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware("guest");

Route::post('/login',[LoginController::class,"handleLogin"])->name("login")->middleware("guest");

Route::middleware("auth")->group(function(){
    Route::get('/dashboard',[DashboardController::class,"index"])->name("dashboard");
    Route::post('/logout',[LoginController::class,"logout"])->name("logout");
});
