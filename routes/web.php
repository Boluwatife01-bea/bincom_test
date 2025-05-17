<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/polling-unit-results', [ResultController::class, 'showPollingUnitResult'])->name('result.polling-unit');
Route::get('/lga-results', [ResultController::class, 'showLgaResultForm'])->name('lga.result.form');
Route::get('/lga/total-results', [ResultController::class, 'showLgaResult'])->name('result.lga.total');
Route::get('/results/create', [ResultController::class, 'createResultForm'])->name('result.create');
Route::post('/results', [ResultController::class, 'storeResult'])->name('result.store');

