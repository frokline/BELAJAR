<?php

namespace App\Http\Controllers;


use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\DetailBarangKeluar;
use App\Models\Barang;
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
        $semuaBarang = Barang::all();

        //auto generate nomor nota sederhana
        $today = date('Ymd');
        $latest = Penjualan::whereRaw("DATE(tanggal) = CURDATE()")->latest()->first();
        $nextSquence = $latest ? str_pad(((int) substr($latest->nomor_nota, -4)) + 1, 4, '0', STR_PAD_LEFT) : '0001';
        $nomorNotaAuto = 'INV-' . $today . '-' . $nextSquence;

        return view('penjualan.create', compact('semuaPelanggan', 'semuaBarang', 'nomorNotaAuto'));
    }

    //validasi input untuk tabel penjualan saja
    public function store(Request $request)
    {
        $request->validate([
            'nomor_nota' => 'required|unique:penjualans,nomor_nota',
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'subtotal' => 'required|numeric',
            'diskon' => 'nullable|numeric',
            'pajak' => 'nullable|numeric',
            'total' => 'required|numeric',
            'bayar' => 'required|numeric',
            'metode_pembayaran' => 'required|in:cash,qris,transfer,debit',

            //validasi barang yang di beli
            'items' => 'required|array|min:1',
            'items.*.barang_id' => 'nullable|exists:barangs,id',
            'items.*.jumlah' => 'nullable|integer|min:1',
        ]);


        $subtotal = $request->subtotal;
        $diskon = $request->diskon ?? 0;
        $pajak = $request->pajak ?? 0;
        $total = $subtotal - $diskon + $pajak;
        $kembalian = $request->bayar - $total;



        if ($request->bayar < $total) {
            return redirect()->back()->withErrors(['bayar' => 'Jumlah bayar tidak boleh kurang dari total.'])->withInput();
        }

        //simpan hanya ke tabel penjualan
        $penjualan = Penjualan::create([
            'nomor_nota' => $request->nomor_nota,
            'tanggal' => now(),
            'id_pelanggan' => $request->id_pelanggan,
            'subtotal' => $subtotal,
            'diskon' => $diskon,
            'pajak' => $pajak,
            'total' => $total,
            'bayar' => $request->bayar,
            'kembalian' => $kembalian,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status' => $kembalian == 0 ? 'lunas' : 'piutang',
        ]);

        //simpan detaail barang keluar & dan potong stok barang
        foreach ($request->items as $item) {

            //lewati barang yang kosong
            if (empty($item['barang_id']) || empty($item['jumlah'])) {
                continue;
            }
            
            $barang = Barang::findOrFail($item['barang_id']);

            //simpan ke tabel detal barang keluar
            DetailBarangKeluar::create([
                'penjualan_id' => $penjualan->id,
                'barang_id' => $barang->id,
                'jumlah_keluar' => $item['jumlah'],
                'harga_jual' => $barang->harga_jual,
                'subtotal' => $barang->harga_jual * $item['jumlah'],
            ]);

            //potong stok barang
            $barang->decrement('stok', $item['jumlah']);
        }

        return redirect('/penjualan')->with('sukses', 'Data penjualan berhasil ditambahkan!');



    }

    public function show($id)
    {
        $penjualan = Penjualan::with('pelanggan', 'detailBarangKeluars.barang')->findOrFail($id);

        return view('penjualan.show', compact('penjualan'));
    }


}

