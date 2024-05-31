<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
//Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AbsensiAdminController;
use App\Http\Controllers\Admin\InstansiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportAdminController;
use App\Http\Controllers\Admin\SettingController;

//User
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\User\AbsensiUserController;
use App\Http\Controllers\User\ReportUserController;
use App\Http\Controllers\User\SettingUserController;

Route::get('/', [LoginController::class, 'index'])->middleware('guest');

// Authentication
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

//Admin Dashboard
Route::prefix('admin')
        ->middleware(['auth','admin'])
        ->group(function(){
            Route::get('/dashboard',[DashboardController::class, 'index'])->name('admin-dashboard');
            //Data Absensi
            Route::resource('presensi', AbsensiAdminController::class);
            Route::post('/reset-data',[AbsensiAdminController::class, 'reset_data'])->name('reset-data');

            //Data Instansi
            Route::resource('instansi', InstansiController::class);
            //Data User
            Route::resource('user', UserController::class);
            //Data Laporan
            Route::resource('report', ReportAdminController::class);
            Route::get('/export-data-absensi/{date1}/{date2}',[ReportAdminController::class, 'export_data'])->name('export-data-absensi');

            //Pengaturan
            Route::get('setting',[SettingController::class, 'index'])->name('setting.index');
            Route::put('setting/{id}',[SettingController::class, 'update'])->name('setting.update');
            Route::post('setting/upload-profile', [SettingController::class, 'upload_profile'])->name('profile-upload');
            Route::get('setting/delete-profile/{id}',[SettingController::class, 'destroy_profile'])->name('profile-delete');
            Route::get('setting/password',[SettingController::class, 'change_password'])->name('change-password');
            Route::post('change-password', [SettingController::class, 'update_password'])->name('update.password');

        });

//User Dashboard
//Admin Dashboard
Route::prefix('user')
        ->middleware(['auth','user'])
        ->group(function(){
            Route::get('/dashboard-user',[DashboardUserController::class, 'index'])->name('user-dashboard');
            //Data Absensi
            Route::resource('absensi', AbsensiUserController::class);
            Route::get('/absensi-pulang',[AbsensiUserController::class, 'get_back'])->name('absensi-pulang');
            Route::get('/absensi-izin',[AbsensiUserController::class, 'get_permission'])->name('absensi-izin');
            //Data Laporan
            Route::resource('report-user', ReportUserController::class);

            //Pengaturan
            Route::get('setting-user',[SettingUserController::class, 'index'])->name('setting-user.index');
            Route::put('setting-user/{id}',[SettingUserController::class, 'update'])->name('setting-user.update');
            Route::post('setting-user/upload-profile', [SettingUserController::class, 'upload_profile'])->name('profile-upload-user');
            Route::get('setting-user/delete-profile/{id}',[SettingUserController::class, 'destroy_profile'])->name('profile-delete-user');
            Route::get('setting-user/password',[SettingUserController::class, 'change_password'])->name('change-password-user');
            Route::post('change-password-user', [SettingUserController::class, 'update_password'])->name('update.password-user');
        });