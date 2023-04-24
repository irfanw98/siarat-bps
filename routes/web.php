<?php

use Illuminate\Support\Facades\{
    Route,
    Auth
};

Route::get('/', function () {
    return redirect('login');
});

Auth::routes(['register' => false]);
Route::group(['middleware' => ['auth']], function() {
    //TU
    Route::group(['middleware' => ['role:tu']], function() {
        Route::get('/dashboard-tu', [App\Http\Controllers\Tu\DashboardTuController::class, 'index'])->name('dashboard.tu');
        Route::resource('users', App\Http\Controllers\Tu\UserController::class, ['except' => 'show']);
        Route::post('/surat-masuk/pdf', [App\Http\Controllers\Tu\SuratMasukController::class, 'cetakPdf'])->name('surat-masuk.pdf');
        Route::resource('surat-masuk', App\Http\Controllers\Tu\SuratMasukController::class);
        Route::post('/surat-keluar/pdf', [App\Http\Controllers\Tu\SuratKeluarController::class, 'cetakPdf'])->name('surat-keluar.pdf');
        Route::resource('surat-keluar', App\Http\Controllers\Tu\SuratKeluarController::class);
    });
    //Kepala
    Route::group(['middleware' => ['role:kepala']], function() {
        Route::get('/dashboard-kepala', [App\Http\Controllers\Kepala\DashboardKepalaController::class, 'index'])->name('dashboard.kepala');
        Route::resource('disposisi', App\Http\Controllers\Kepala\DisposisiKepalaController::class);
        Route::resource('/kepala/surat-masuk', App\Http\Controllers\Kepala\SuratMasukKepalaController::class)->only(['index','show']);
        Route::resource('/kepala/surat-keluar', App\Http\Controllers\Kepala\SuratKeluarKepalaController::class)->only(['index','show']);
    });
    //Pegawai
    Route::group(['middleware' => ['role:pegawai']], function() {
        Route::get('/dashboard-pegawai', [App\Http\Controllers\Pegawai\DashboardPegawaiController::class, 'index'])->name('dashboard.pegawai');
        Route::resource('disposisi-pegawai', App\Http\Controllers\Pegawai\DisposisiPegawaiController::class)->only(['index','update']);
        Route::resource('/pegawai/surat-keluar', App\Http\Controllers\Pegawai\SuratKeluarPegawaiController::class)->only(['index','show']);
    });
    Route::get('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout');
});