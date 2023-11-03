<?php

use App\Http\Controllers\ApproveBeritaController;
use App\Http\Controllers\BeritaAcaraController;
use App\Http\Controllers\BeritaAcaraDetailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Models\BeritaAcaraDetail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/')->middleware('auth');
Route::get('/template', function () {
    return view('dashboard.template.berita');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});

Route::resource('/profile', ProfileController::class)->middleware('auth');

Route::prefix('/dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');

    Route::resource('/user', UserController::class)->except(['create', 'show', 'edit'])->middleware('auth');

    Route::put('/resetpassword/{user}', [ResetPasswordController::class, 'resetPasswordAdmin'])->name('resetpassword.resetPasswordAdmin')->middleware('auth');

    Route::resource('/staff', StaffController::class)->except(['create', 'show', 'edit'])->middleware('auth');
    Route::resource('/jabatan', JabatanController::class)->except(['create', 'show', 'edit'])->middleware('auth');
    Route::resource('/berita', BeritaAcaraController::class)->except(['create', 'edit'])->middleware('auth');
    Route::post('/berita/{beritum}/approve', [BeritaAcaraController::class, 'approve'])->name('berita.approve');
    Route::post('/berita/{beritum}/disapprove', [BeritaAcaraController::class, 'disapprove'])->name('berita.disapprove');
    Route::get('/berita/{berita}/generate-pdf', [BeritaAcaraController::class,'generatePDF'])->name('berita-template.pdf');
    Route::resource('/berita-detail', BeritaAcaraDetailController::class)->except(['create', 'show', 'edit'])->middleware('auth');
});
