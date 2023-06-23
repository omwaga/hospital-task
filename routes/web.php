<?php

use App\Http\Controllers\LabTestController;
use App\Http\Controllers\MedicalReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [App\Http\Controllers\PatientController::class, 'index'])->name('home');

    Route::resource('patients', PatientController::class);
    Route::resource('lab-tests', LabTestController::class);
    Route::resource('medical-reports', MedicalReportController::class);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/generate-report/{patient}', [App\Http\Controllers\PatientController::class, 'generateReport'])->name('generate-report');
});

Auth::routes();
