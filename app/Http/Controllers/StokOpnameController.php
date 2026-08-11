<?php

namespace App\Http\Controllers;

use App\Models\StokOpname;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokOpnameController extends Controller
{
    public function index()
    {
        $stokOpname = StokOpname::with('barang')->orderBy('tanggal', 'desc')->get();

        return view('stok-opname.index', compact('stokOpname'));
    }

    public function create()
    {
        $semuaBarang = Barang::all();
        $tanggalHariIni = date('Y-m-d');

        return view('stok-opname.create', compact('semuaBarang', 'tanggalHariIni'));
    }

    //memproses pencatatan stok opname dan menimpa stok pisik di tabel barang
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tanggal' => 'required|date',
            'stok_fisik' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        return DB::transaction(function () use ($request) {
            // ambil data barang secara real-time dari database
            $barang = Barang::findOrFail($request->barang_id);


            $stokSistem = $barang->stok; //ambil stok sistem berdasarkan data barang yang di pilih user sebelumnya
            $selisih = $request->stok_fisik - $stokSistem;

        // Simpan data stok opname
        StokOpname::create([
            'barang_id' => $request->barang_id,
            'tanggal' => $request->tanggal,
            'stok_fisik' => $request->stok_fisik,
            'stok_sistem' => $stokSistem,
            'selisih' => $selisih,
            'keterangan' => $request->keterangan,
        ]);

        // Update stok fisik di tabel barang
        $barang->update([
            'stok' => $request->stok_fisik
            ]);

    
            return redirect()->route('stok-opname.index')->with('success', 'Stok opname berhasil dicatat dan stok fisik diperbarui.');
        });
    }

}
