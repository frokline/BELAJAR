<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\SupplierController; // 1. Kita panggil Manajer Supplier di sini
use App\Http\Controllers\BarangController; //
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KategoriBarangController; // 1. Kita panggil Manajer Kategori Barang di sini
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\PenjualanController;// 1. Kita panggil Manajer Barang Masuk di sini
use App\Http\Controllers\StokOpnameController; // 1. Kita panggil Manajer Stok Opname di sini
use App\Http\Controllers\HargaBarangHistoryController; // 1. Kita panggil Manajer Stok Opname di sini

use Illuminate\Support\Facades\Route;

// ============================================
// ROUTE PUBLIK (TANPA LOGIN)
// ============================================

// Halaman Login (HARUS publik, tidak boleh di middleware auth)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);

// Halaman Utama
Route::get('/', [DashboardController::class, 'index']);

// ============================================
// ROUTE YANG MEMERLUKAN LOGIN
// ============================================

Route::middleware('auth')->group(function() {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Rute Halaman Supplier Toko Kita
    Route::get('/supplier', [SupplierController::class, 'index']);
    Route::get('/supplier/tambah', [SupplierController::class, 'create']);
    Route::post('/supplier/simpan', [SupplierController::class, 'store']);
    Route::get('/supplier/edit/{supplier}', [SupplierController::class, 'edit']);
    Route::post('/supplier/update/{supplier}', [SupplierController::class, 'update']);
    Route::get('/supplier/hapus/{supplier}', [SupplierController::class, 'destroy']);

    // Rute Halaman Barang
    Route::get('/barang', [BarangController::class, 'index']);
    Route::get('/barang/tambah', [BarangController::class, 'create']);
    Route::post('/barang/simpan', [BarangController::class, 'store']);
    Route::get('/barang/edit/{barang}', [BarangController::class, 'edit']);
    Route::post('/barang/update/{barang}', [BarangController::class, 'update']);
    Route::get('/barang/hapus/{barang}', [BarangController::class, 'destroy']);

    // Rute Halaman Pelanggan
    Route::get('/pelanggan', [PelangganController::class, 'index']);
    Route::get('/pelanggan/tambah', [PelangganController::class, 'create']);
    Route::post('/pelanggan/simpan', [PelangganController::class, 'store']);
    Route::get('/pelanggan/edit/{pelanggan}', [PelangganController::class, 'edit']);
    Route::post('/pelanggan/update/{pelanggan}', [PelangganController::class, 'update']);
    Route::get('/pelanggan/hapus/{pelanggan}', [PelangganController::class, 'destroy']);

    // Rute Halaman Kategori Barang
    Route::get('/kategori-barang', [KategoriBarangController::class, 'index']);
    Route::get('/kategori-barang/tambah', [KategoriBarangController::class, 'create']);
    Route::post('/kategori-barang/simpan', [KategoriBarangController::class, 'store']);
    Route::get('/kategori-barang/edit/{kategoriBarang}', [KategoriBarangController::class, 'edit']);
    Route::post('/kategori-barang/update/{kategoriBarang}', [KategoriBarangController::class, 'update']);
    Route::get('/kategori-barang/hapus/{kategoriBarang}', [KategoriBarangController::class, 'destroy']);

    // Rute Halaman Barang Masuk
    Route::get('/barang-masuk', [BarangMasukController::class, 'index']);
    Route::get('/barang-masuk/tambah', [BarangMasukController::class, 'create']);
    Route::post('/barang-masuk/simpan', [BarangMasukController::class, 'store']);
    Route::get('/barang-masuk/edit/{barangMasuk}', [BarangMasukController::class, 'edit']);
    Route::post('/barang-masuk/update/{barangMasuk}', [BarangMasukController::class, 'update']);
    Route::get('/barang-masuk/hapus/{barangMasuk}', [BarangMasukController::class, 'destroy']);

    // Rute Halaman Penjualan
    Route::get('/penjualan', [PenjualanController::class, 'index']);
    Route::get('/penjualan/tambah', [PenjualanController::class, 'create']);
    Route::post('/penjualan/simpan', [PenjualanController::class, 'store']);
    Route::get('/penjualan/edit/{penjualan}', [PenjualanController::class, 'edit']);
    Route::post('/penjualan/update/{penjualan}', [PenjualanController::class, 'update']);
    Route::get('/penjualan/{id}', [PenjualanController::class, 'show']);
    Route::get('/penjualan/hapus/{penjualan}', [PenjualanController::class, 'destroy']);

    // Rute Halaman Stok Opname
    Route::get('/stok-opname', [StokOpnameController::class, 'index'])->name('stok-opname.index');
    Route::get('/stok-opname/tambah', [StokOpnameController::class, 'create'])->name('stok-opname.create');
    Route::post('/stok-opname/simpan', [StokOpnameController::class, 'store'])->name('stok-opname.store');

    // Rute History Harga Barang
    Route::get('/riwayat-harga', [HargaBarangHistoryController::class, 'index']);

    // Rute Audit Log
    Route::get('/audit-log', [AuditLogController::class, 'index']);

    // Rute Profil Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
