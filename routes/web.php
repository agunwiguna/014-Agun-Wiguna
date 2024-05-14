<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login',[
        'title' => 'Login',
    ]);
});

//Admin Dashboard
Route::get('/admin/dashboard', function () {
    return view('pages.admin.dashboard',[
        'title' => 'Dashboard',
    ]);
});

Route::get('/admin/absensi', function () {
    return view('pages.admin.absensi.index',[
        'title' => 'Absensi',
    ]);
});

Route::get('/admin/user', function () {
    return view('pages.admin.user.index',[
        'title' => 'Data User',
    ]);
});

Route::get('/admin/instansi', function () {
    return view('pages.admin.instansi.index',[
        'title' => 'Data Instansi',
    ]);
});

Route::get('/admin/report', function () {
    return view('pages.admin.report.index',[
        'title' => 'Laporan Absensi',
    ]);
});

Route::get('/admin/setting', function () {
    return view('pages.admin.setting.index',[
        'title' => 'Pengaturan',
    ]);
});