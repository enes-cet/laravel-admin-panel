<?php

use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin/genel-gorunum', [AdminController::class,'index'])->name('admin.index')->middleware('auth');
Route::get('/admin', [AdminController::class,'login'])->name('login');
Route::get('/admin/kayit-ol', [AdminController::class,'register'])->name('admin.register');
Route::get('/admin/sifremi-unuttum', [AdminController::class,'forgotPassword'])->name('admin.forgot-password');

Route::post('/admin/login', [MemberController::class,'login'])->name('member.login');
Route::get('/admin/logout', [MemberController::class,'logout'])->name('member.logout');
Route::post('/admin/register', [MemberController::class,'register'])->name('member.register');

Route::get('/admin/kullanicilar', [UserController::class,'index'])->name('admin.users.index');