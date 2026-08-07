<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier; 
use App\Models\KategoriBarang; // ✅ Panggil model kategori di atas
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        // mengambil semua barang berserta kategorinya masiang masiang 
        //ambil semua barang, dan jalankan relasi yang bernama KategoriBaranag
        $semuaBarang = Barang::with('kategoriBarang')->get();

        return view('barang.barang-index', compact('semuaBarang'));
    }

    public function create()
    {
        $semuaSupplier = Supplier::all();
        $semuaKategori = KategoriBarang::all(); // ✅ Ambil semua data kategori untuk dropdown

        return view('barang.barang-create', compact('semuaSupplier', 'semuaKategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_barang_id' => 'required|exists:kategori_barangs,id', // ✅ Validasi wajib ada di database
            'id_supplier'        => 'required',
            'nama_barang'        => 'required',
            'harga_jual'         => 'required|numeric',
            'stok'               => 'required|numeric',
        ]);

        Barang::create([
            'kategori_barang_id' => $request->kategori_barang_id, // ✅ Simpan kolom baru
            'id_supplier'        => $request->id_supplier,
            'nama_barang'        => $request->nama_barang,
            'harga_jual'         => $request->harga_jual,
            'stok'               => $request->stok,
        ]);

        return redirect('/barang')->with('sukses', 'Data barang berhasil ditambahkan!');
    }

    public function edit(Barang $barang)
    {
        $semuaSupplier = Supplier::all();
        $semuaKategori = KategoriBarang::all(); //  Ambil data kategori untuk form edit

        return view('barang.barang-edit', compact('barang', 'semuaSupplier', 'semuaKategori'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'kategori_barang_id' => 'required|exists:kategori_barangs,id', // ✅ Validasi update
            'id_supplier'        => 'required',
            'nama_barang'        => 'required',
            'harga_jual'         => 'required|numeric',
            'stok'               => 'required|numeric',
        ]);

        $barang->update([
            'kategori_barang_id' => $request->kategori_barang_id, // ✅ Update kolom baru
            'id_supplier'        => $request->id_supplier,
            'nama_barang'        => $request->nama_barang,
            'harga_jual'         => $request->harga_jual,
            'stok'               => $request->stok,
        ]);

        return redirect('/barang')->with('sukses', 'Data barang berhasil diperbarui!');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect('/barang')->with('sukses', 'Data barang berhasil dihapus!');
    }
}