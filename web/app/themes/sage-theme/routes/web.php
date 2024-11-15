<?php

use App\Http\Controllers\VacController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

Route::get('/vac', [VacController::class, 'index'])->name('vac');
Route::post('/vac/subject', [VacController::class, 'findBySubject'])->name('vac.subject');
Route::get('/vac/{external_id}', [VacController::class, 'show'])->name('vac.show');
