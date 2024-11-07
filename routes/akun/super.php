<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Super\DashboardController as Dashboard;
use App\Http\Controllers\Super\MasterData\MGolDarahController as MGolDarah;
use App\Http\Controllers\Super\MasterData\MPenyakitController as MPenyakit;
use App\Http\Controllers\Super\MasterData\MPekerjaanController as MPekerjaan;
use App\Http\Controllers\Super\MasterData\MJenisKelaminController as MJenisKelamin;
use App\Http\Controllers\Super\MasterData\MRhesusController as MRhesus;


Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [Dashboard::class, 'index'])->name('index');
});
Route::prefix('master_data')->name('master_data.')->group(function () {
    Route::prefix('gol_darah')->name('gol_darah.')->group(function () {
        Route::get('/', [MGolDarah::class, 'index'])->name('index');
        Route::get('/data', [MGolDarah::class, 'data'])->name('data');
        Route::post('/createOrUpdate/{id?}', [MGolDarah::class, 'createOrUpdate'])->name('createOrUpdate');
        Route::get('/show-data/{id}', [MGolDarah::class, 'show'])->name('show');
        Route::post('/delete-data/{id}', [MGolDarah::class, 'delete'])->name('delete');
    });
    Route::prefix('penyakit')->name('penyakit.')->group(function () {
        Route::get('/', [MPenyakit::class, 'index'])->name('index');
        Route::get('/data', [MPenyakit::class, 'data'])->name('data');
        Route::post('/createOrUpdate/{id?}', [MPenyakit::class, 'createOrUpdate'])->name('createOrUpdate');
        Route::get('/show-data/{id}', [MPenyakit::class, 'show'])->name('show');
        Route::post('/delete-data/{id}', [MPenyakit::class, 'delete'])->name('delete');
    });
    Route::prefix('pekerjaan')->name('pekerjaan.')->group(function () {
        Route::get('/', [MPekerjaan::class, 'index'])->name('index');
        Route::get('/data', [MPekerjaan::class, 'data'])->name('data');
        Route::post('/createOrUpdate/{id?}', [MPekerjaan::class, 'createOrUpdate'])->name('createOrUpdate');
        Route::get('/show-data/{id}', [MPekerjaan::class, 'show'])->name('show');
        Route::post('/delete-data/{id}', [MPekerjaan::class, 'delete'])->name('delete');
    });
    Route::prefix('jenis_kelamin')->name('jenis_kelamin.')->group(function () {
        Route::get('/', [MJenisKelamin::class, 'index'])->name('index');
        Route::get('/data', [MJenisKelamin::class, 'data'])->name('data');
        Route::post('/createOrUpdate/{id?}', [MJenisKelamin::class, 'createOrUpdate'])->name('createOrUpdate');
        Route::get('/show-data/{id}', [MJenisKelamin::class, 'show'])->name('show');
        Route::post('/delete-data/{id}', [MJenisKelamin::class, 'delete'])->name('delete');
    });
    Route::prefix('rhesus')->name('rhesus.')->group(function () {
        Route::get('/', [MRhesus::class, 'index'])->name('index');
        Route::get('/data', [MRhesus::class, 'data'])->name('data');
        Route::post('/createOrUpdate/{id?}', [MRhesus::class, 'createOrUpdate'])->name('createOrUpdate');
        Route::get('/show-data/{id}', [MRhesus::class, 'show'])->name('show');
        Route::post('/delete-data/{id}', [MRhesus::class, 'delete'])->name('delete');
    });
});
