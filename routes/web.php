<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemPenjualanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\JenisProdukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\MidtransNotificationController;

Route::post('/payments/midtrans/notification', MidtransNotificationController::class)
    ->name('payments.midtrans.notification');

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/login', [AuthController::class, 'auth'])->name('auth');
        Route::post('/register', [AuthController::class, 'register'])->name('register');

        // Lupa Password
        Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
        Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
        Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
        Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::middleware('role:Admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users'); 
        Route::get('/users/create',  [UserController::class, 'create'])->name('users.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/update/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/destroy/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/audit-log', [AuditLogController::class, 'index'])->name('audit-log.index');
    });

    Route::middleware('role:Admin')->group(function () {
        Route::resource('/jenis-produk', JenisProdukController::class)
            ->except(['index', 'show']);
        Route::resource('/produk', ProdukController::class)
            ->only(['create', 'store', 'edit', 'update', 'destroy']);
    });

    Route::middleware(['role:Admin,Kasir'])->group(function () {
        Route::resource('/jenis-produk', JenisProdukController::class)->only(['index']);
        Route::resource('/produk', ProdukController::class)->only(['index', 'show']);
        Route::resource('/penjualan', PenjualanController::class);
        Route::resource('/itempenjualan', ItemPenjualanController::class);
        Route::get('/penjualan/{penjualan}/cetak', [PenjualanController::class,'cetak'])->name('penjualan.cetak');

        // QRIS
        Route::get('/penjualan/{id}/qris', [PenjualanController::class, 'qris'])->name('penjualan.qris');
        Route::post('/penjualan/{id}/bayar', [PenjualanController::class, 'konfirmasiBayar'])->name('penjualan.bayar');
        Route::get('/penjualan/{penjualan}/payment-status', [PenjualanController::class, 'paymentStatus'])->name('penjualan.payment-status');

        // Laporan Penjualan
        Route::get('/laporan-penjualan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan-penjualan/export/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');
        Route::get('/laporan-penjualan/export/excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/pengaturan', [SettingController::class, 'index'])->name('pengaturan.index');
        Route::put('/pengaturan', [SettingController::class, 'update'])->name('pengaturan.update');
        Route::get('/pengaturan/edit', [SettingController::class, 'edit'])->name('pengaturan.edit');
        Route::get('/pengaturan/tentang', function () {return view('pengaturan.tentang');})->name('pengaturan.tentang');
    });
});
