<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Livewire\DashboardPage;

Route::get('/', DashboardPage::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', DashboardPage::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('user', UserController::class);
    Route::resource('classroom', ClassController::class);
    Route::resource('teacher', TeacherController::class);
    Route::get('classroom/destroy/{id}', [ClassController::class, 'destroy'])->name('classroom.destroy');
    Route::resource('student', StudentController::class);
    Route::resource('spp', SppController::class);
    Route::resource('major', MajorController::class);

    Route::get('/config', [ConfigurationController::class, 'index']);
});

require __DIR__ . '/auth.php';
