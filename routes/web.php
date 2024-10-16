<?php

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('appointments', AppointmentsController::class);
    Route::resource('doctors', DoctorsController::class);
    Route::resource('patients', PatientsController::class);
    Route::resource('services', ServicesController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('users', UsersController::class);
});

require __DIR__.'/auth.php';
