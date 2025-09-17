<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ControllerDashboard;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\ControllerDashboard::class, 'index'])->name('dashboard');
