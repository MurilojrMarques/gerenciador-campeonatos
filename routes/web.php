<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeController;


Route::get('/', function () {return view('home');});
Route::get('/times', [TimeController::class, 'index'])->name('times.index');
Route::get('/times/create', [TimeController::class, 'create'])->name('times.create');
Route::post('/times', [TimeController::class, 'store'])->name('times.store');
Route::get('/times/sortear-confrontos', [TimeController::class, 'sortearConfrontos'])->name('times.sortear-confrontos');