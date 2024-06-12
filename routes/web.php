<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/auth', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'auth']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/404', [AuthController::class, 'error404']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/audio', [DashboardController::class, 'audio']);

    Route::get('/user', [UserController::class, 'index'])->middleware('IsAdmin');
    Route::post('/simpanUser', [UserController::class, 'simpan'])->middleware('IsAdmin');
    Route::put('/updateuser', [UserController::class, 'update'])->middleware('IsAdmin');
    Route::get('/delete-user/{id}', [UserController::class, 'hapus'])->middleware('IsAdmin');

    // ALL 
    Route::get('/student', [StudentController::class, 'index']);
    Route::post('/simpanSiswa', [StudentController::class, 'simpan']);
    Route::put('/updateStudent', [StudentController::class, 'update']);
    Route::get('/delete-student', [StudentController::class, 'hapus']);

    // PERKELAS
    Route::get('/student/class/{tahun_masuk}/{id}', [StudentController::class, 'studentClass']);
    Route::get('/student/pembayaran/{student_id}/{class}/{thn1}/{thn2}', [StudentController::class, 'pembayaran'])->name('student.pembayaran');
    Route::post('/student/bayar', [StudentController::class, 'bayar']);
    Route::get('/student/transaksi/{id}', [StudentController::class, 'transaksi']);
    Route::get('/student/cetak-nota/{student_id}/{id}', [StudentController::class, 'cetakNota']);
    Route::get('/student/cetak-laporan/{tahun_masuk}/{class_id}', [StudentController::class, 'cetakLaporan']);


    Route::get('/classroom', [ClassController::class, 'index']);
    Route::post('/simpanClass', [ClassController::class, 'simpan']);
    Route::get('/class-eksport-excel', [ClassController::class, 'eksport_excel']);
    Route::post('/class-import-excel', [ClassController::class, 'import_excel']);
    Route::put('/updateClass', [ClassController::class, 'update']);
    Route::get('/delete-class/{id}', [ClassController::class, 'hapus']);

    Route::get('/spp', [SppController::class, 'index']);
    Route::prefix('spp')->controller(SppController::class)->group(function () {
        Route::post('/simpanSPP', 'simpan');
        Route::put('/updateSPP', 'update');
        Route::get('/hapus-SPP/{id}', 'hapus');
    });

    Route::get('/config', [ConfigurationController::class, 'index']);
    Route::put('/update-config', [ConfigurationController::class, 'update']);
});
