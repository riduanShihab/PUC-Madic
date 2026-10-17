<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('doctors', DoctorController::class);
    Route::resource('patients', PatientController::class);
    Route::resource('appointments', AppointmentController::class);
});

Route::get('/test', function () {
    return view('doctors.create');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ❌ REMOVE this:
// Route::get('/doctors/{id}/edit', function ($id) {
//     return "<h1>Edit Doctor #$id</h1>";
// });

// ❌ ALSO remove this if you already have `Route::resource(...)`:
// Route::get('/doctors/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');




