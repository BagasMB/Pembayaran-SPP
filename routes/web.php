<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Livewire\ConfigurationPage;
use App\Livewire\DashboardPage;
use App\Livewire\Student\CariStudentPage;

Route::get('/', DashboardPage::class)->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', DashboardPage::class)->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/cari-siswa', CariStudentPage::class)->name('cari-siswa');
Route::get('/transaksi-siswa/{id}', [StudentController::class, 'transaksiSiswa']);

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

    Route::get('/student/class/{tahun_masuk}/{id}', [StudentController::class, 'studentClass']);
    Route::get('/student/pembayaran/{student_id}/{class}/{thn1}/{thn2}', [StudentController::class, 'pembayaran'])->name('student.pembayaran');
    Route::get('/student/transaksi/{id}', [StudentController::class, 'transaksi'])->name('student.transaksi');

    Route::get('/config', ConfigurationPage::class);

    Route::get('/student/cetak-nota/{student_id}/{id}', [StudentController::class, 'cetakNota']);
});

require __DIR__ . '/auth.php';
