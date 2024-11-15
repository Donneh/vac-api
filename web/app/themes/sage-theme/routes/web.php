<?php

use App\Http\Controllers\MinistryController;
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

Route::get('/questions', [VacController::class, 'index'])->name('vac');
Route::post('/questions/subject', [VacController::class, 'findBySubject'])->name('vac.subject');
Route::post('/questions/ministry', [VacController::class, 'findByMinistry'])->name('vac.find');
Route::get('/questions/{external_id}', [VacController::class, 'show'])->name('vac.show');

Route::get('/ministries', [MinistryController::class, 'index'])->name('ministries');
