<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BookloanController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardMemberController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('guest')->group(function(){
    Route::get('login',[AuthController::class,'login'])->name('login');
    Route::post('login',[AuthController::class,'auth'])->name('auth');
    Route::get('register',[AuthController::class,'register'])->name('register');
    Route::post('register',[AuthController::class,'register_process'])->name('register_process');
});
Route::middleware('auth')->group(function(){
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
    Route::get('admin/dashboard',[DashboardAdminController::class,'index'])->name('admin.dashboard');
    Route::get('admin/data_member',[MemberController::class,'index'])->name('data_member');
    Route::post('members/{id}/activate', [MemberController::class, 'activate'])->name('members.activate');
    Route::get('admin/data_buku',[BookController::class,'index'])->name('data_buku');
    Route::get('admin/tambah_buku',[BookController::class,'tambah_buku'])->name('tambah_buku');
    Route::post('admin/tambah_buku',[BookController::class,'tambah_buku_aksi'])->name('tambah_buku_aksi');
    Route::get('admin/update_buku/{id}',[BookController::class,'update_buku'])->name('update_buku');
    Route::put('/admin/update_buku/{id}', [BookController::class, 'update_buku_aksi'])->name('update_buku_aksi');
    Route::delete('admin/delete_buku/{id}',[BookController::class,'delete_buku'])->name('delete_buku');

    Route::get('member/dashboard',[DashboardMemberController::class,'index'])->name('member.dashboard');
    Route::get('/member/pinjam_buku', [BookloanController::class, 'index'])->name('pinjam_buku');
    Route::post('/member/pinjam_buku/{id}', [BookloanController::class, 'loan'])->name('loan');
    Route::patch('/member/return/{id}', [DashboardMemberController::class, 'returnBook'])->name('member.return');
});
