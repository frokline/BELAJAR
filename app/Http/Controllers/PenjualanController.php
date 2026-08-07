<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()

    // mengambil data penjualan beserta relasi ke pelanggan
    {
        $semuaPenjualan = Penjualan::with('pelanggan')
                                    ->orderBy('id', 'desc') // Urutkan berdasarkan id terbaru
                                    ->get();
        
        return view('penjualan.index', compact('semuaPenjualan'));
    }

    public function create()
    {
        $semuaPelanggan = Pelanggan::all();

        //auto generate nomor nota sederhana
        $today = date('Ymd');
        $latest = Penjualan::whereRaw("DATE(tanggal) = CURDATE()")->latest()->first();
        $nextSquence = $latest ? str_pad(((int) substr($latest->nomor_nota, -4)) + 1, 4, '0', STR_PAD_LEFT) : '0001';
        $nomorNotaAuto = 'INV-' . $today . '-' . $nextSquence;

        return view('penjualan.create', compact('semuaPelanggan', 'nomorNotaAuto'));
    }

    //validaso input untuk tabel penjualan saja
    public function store(Request $request)
    {
        $request->validate([
            'nomor_nota' => 'required|unique:penjualans,nomor_nota',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'subtotal' => 'required|numeric',
            'diskon' => 'nullable|numeric',
            'pajak' => 'nullable|numeric',
            'total' => 'required|numeric',
            'bayar' => 'required|numeric',
            'metode_pembayaran' => 'required|in:cash,qris,transfer,debit',
        ]);

        $subtotal = $request->subtotal;
        $diskon = $request->diskon ?? 0; // jika null, set ke 0
        $pajak = $request->pajak ?? 0; // jika null, set ke 0
        $total = $subtotal - $diskon + $pajak;
        $kembalian = $request->bayar - $total;

        if ($request->bayar < $total) {
            return redirect()->back()->withErrors(['bayar' => 'Jumlah bayar tidak boleh kurang dari total.'])->withInput();
        }

        //simpan hanya ke tabel penjualan
        Penjualan::create([
            'nomor_nota' => $request->nomor_nota,
            'tanggal' => now(),
            'pelanggan_id' => $request->pelanggan_id,
            'subtotal' => $subtotal,
            'diskon' => $diskon,
            'pajak' => $pajak,
            'total' => $total,
            'bayar' => $request->bayar,
            'kembalian' => $kembalian,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status' => $kembalian == 0 ? 'lunas' : 'piutang',
        ]);

        return redirect('/penjualan')->with('sukses', 'Data penjualan berhasil ditambahkan!');



    }

    public function show($id)
    {
        $penjualan = Penjualan::with('pelanggan')->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }


}

     