<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ControllerDashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\ControllerDashboard::class, 'index'])->name('dashboard');
