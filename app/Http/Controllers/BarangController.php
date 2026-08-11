<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier; 
use App\Models\KategoriBarang; // ✅ Panggil model kategori di atas
use App\Models\HargaBarangHistory; // Panggil model harga barang history
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


                // tambahan  baru pencatatan riwayat harga barang baru


        //SIMPAN HARGA LAMA DI DATABASE SEBELUM DI TIMPA
        $hargaBelilama = $barang->harga_beli ?? 0; // Ambil harga beli lama, jika tidak ada set ke 0
        $hargaJuallama = $barang->harga_jual ?? 0; // Ambil harga jual lama, jika tidak ada set ke 0


        //AMBIL HARGA BELI BARU  DARI FORM  (ATAU SET 0 JIKKA FORM BELUM ADA INPUT HARGA BELI)
        $hargaBeliBaru = $request->harga_beli ?? 0;

        //AMBIL HARGA JUAL BARU  DARI FORM  (ATAU SET 0 JIKKA FORM BELUM ADA INPUT HARGA JUAL)
        $hargaJualBaru = $request->harga_jual ?? 0;

        //CEK JIKA ADA PERUBAHAN PADA HARGA BELI ATAU HARGA JUAL
        if ($hargaBeliBaru != $hargaBelilama || $hargaJualBaru != $hargaJuallama) {


        // CATAT OTOMATIS KE BUKU RIWAYAT HARGA BARANG
        HargaBarangHistory::create([
            'user_id' => Auth::id(),
            'barang_id' => $barang->id,
            'harga_beli_lama' => $hargaBelilama,
            'harga_beli_baru' => $hargaBeliBaru,
            'harga_jual_lama' => $hargaJuallama,
            'harga_jual_baru' => $hargaJualBaru
        ]);
    }

        // UPDATE DATA BARANG di database
        $barang->update([
            'kategori_barang_id' => $request->kategori_barang_id, // ✅ Simpan kolom baru
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