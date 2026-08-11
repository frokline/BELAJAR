<?php

namespace App\Http\Controllers;

use App\Models\HargaBarangHistory;
use Illuminate\Http\Request;

class HargaBarangHistoryController extends Controller
{
    public function index()
    {
        $semuaRiwayat = HargaBarangHistory::with('barang')->orderBy('id', 'desc')->get();

        return view('riwayat-harga.index', compact('semuaRiwayat'));
    }

    
}
