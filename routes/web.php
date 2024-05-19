<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
//Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InstansiController;
use App\Http\Controllers\Admin\SettingController;

//User
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\User\AbsensiUserController;

Route::get('/', [LoginController::class, 'index'])->middleware('guest');

// Authentication
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

//Admin Dashboard
Route::prefix('admin')
        ->middleware(['auth'])
        ->group(function(){
            Route::get('/dashboard',[DashboardController::class, 'index'])->name('admin-dashboard');
            //Data Instansi
            Route::resource('instansi', InstansiController::class);

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
        ->middleware('auth')
        ->group(function(){
            Route::get('/dashboard-user',[DashboardUserController::class, 'index'])->name('user-dashboard');
            //Data Absensi
            Route::resource('absensi', AbsensiUserController::class);
        });