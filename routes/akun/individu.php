<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Individu\DashboardController as Dashboard;


Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [Dashboard::class, 'index'])->name('index');
});
