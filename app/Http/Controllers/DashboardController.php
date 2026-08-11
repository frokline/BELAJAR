<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\Pelanggan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPenjualan = Penjualan::count();
        $totalBarang = Barang::count();
        $totalPelanggan = Pelanggan::count();

        return view('dashboard', compact('totalPenjualan', 'totalBarang', 'totalPelanggan'));
    }
}