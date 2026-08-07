<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;   //Wajib dipanggil untuk fitur DB Transaction

class BarangMasukController extends Controller
{
    public function index()
    {
        // Ambil semua data barang masuk beserta relasi ke barang dan supplier
        $semuaBarangMasuk = BarangMasuk::with(['barang', 'supplier'])
        ->latest() // Urutkan berdasarkan tanggal masuk terbaru
        ->get();

        return view('barang-masuk.index', compact('semuaBarangMasuk'));
    }

    public function create()
    {
        $semuaBarang = Barang::all();
        $semuaSupplier = Supplier::all();

        return view('barang-masuk.create', compact('semuaBarang', 'semuaSupplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_masuk' => 'required|date',
            'id_barang'     => 'required|exists:barangs,id',
            'id_supplier'   => 'required|exists:suppliers,id',
            'jumlah_masuk'  => 'required|integer|min:1',
            'harga_beli'    => 'required|integer|min:0',
            'keterangan'    => 'nullable|string',
        ]);

        // Menggunakan DB Transaction untuk memastikan integritas data
        DB::transaction(function () use ($request) {
            // Simpan data barang masuk
            $barangMasuk = BarangMasuk::create($request->all());

            // Update stok barang terkait
            $barang = Barang::findOrFail($request->id_barang);
            $barang->increment('stok', $request->jumlah_masuk);
        });

        return redirect('/barang-masuk')->with('sukses', 'Data barang masuk berhasil ditambahkan!');
    }

    public function destroy(BarangMasuk $barangMasuk)
    {
        // Menggunakan DB Transaction untuk memastikan integritas data
        DB::transaction(function () use ($barangMasuk) {
            // Kurangi stok barang terkait
            $barang = Barang::findOrFail($barangMasuk->id_barang);
            $barang->decrement('stok', $barangMasuk->jumlah_masuk);

            // Hapus data barang masuk
            $barangMasuk->delete();
        });

        return redirect('/barang-masuk')->with('sukses', 'Data barang masuk berhasil dihapus!');
    }

    public function edit(BarangMasuk $barangMasuk)
    {
        $semuaBarang = Barang::all();
        $semuaSupplier = Supplier::all();

        return view('barang-masuk.edit', compact('barangMasuk', 'semuaBarang', 'semuaSupplier'));
    }

    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        $request->validate([
            'tanggal_masuk' => 'required|date',
            'id_barang'     => 'required|exists:barangs,id',
            'id_supplier'   => 'required|exists:suppliers,id',
            'jumlah_masuk'  => 'required|integer|min:1',
            'harga_beli'    => 'required|integer|min:0',
            'keterangan'    => 'nullable|string',
        ]);

        // Menggunakan DB Transaction untuk memastikan integritas data
        DB::transaction(function () use ($request, $barangMasuk) {
            // Hitung selisih jumlah masuk baru dan lama
            $selisihJumlah = $request->jumlah_masuk - $barangMasuk->jumlah_masuk;

            // Update stok barang terkait
            $barang = Barang::findOrFail($request->id_barang);
            $barang->increment('stok', $selisihJumlah);

            // Update data barang masuk
            $barangMasuk->update($request->all());
        });

        return redirect('/barang-masuk')->with('sukses', 'Data barang masuk berhasil diperbarui!');
    }

    
    
}
