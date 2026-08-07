<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semuaKategori = KategoriBarang::all();

        return view('kategori-barang.index', compact('semuaKategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori-barang.create');
    }

    

     
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        //fungsi ini menampikna semua data yang dibawa oleh kategoribarang(si model) :: withtrashed atinya termasuk yang di hapus. jika sudah dapat masaukkan ke function ($kategori)
        $kategori = KategoriBarang::withTrashed()
        //cari data yang di bawa oleh user, lalu di cari ke database apakah ada yang sama? jika ada maka akan di tampung ke function ($kategori)
        // cari nama yang sama dengan di input userS
        ->where('nama_kategori', $request->nama_kategori)
        ->first();

        //apakah data di temukan? jika tidak maka lanjut ke (create) pembuatan baru, nah jika di temukan maka akan di lanjutkan dengan function ini
        if($kategori) {

            //apakah data ini sudah di hapus? jalankan restore jika iya
            if ($kategori->trashed()) {

                //akan menjalankan function ini, yaitu mengaktifkannya kembali
                $kategori->restore();

                return redirect('/kategori-barang')
                ->with('sukses', 'Data kategori barang berhasil diaktifkan kembali!');
            }

            // nah kalo si restore ini data nya masiah aktif maka akan di proses oleh
            return back()
            //kembali ke halaman sebelum nya lalu bawa pesan eror
            ->withErrors([
                'nama_kategori' => 'Nama kategori sudah ada. Silakan gunakan nama lain.',
            ])
            ->withInput();
        }

        //kalo emang belum pernah ada data maka buat baru
        KategoriBarang::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect('/kategori-barang')->with('sukses', 'Data kategori barang berhasil diperbarui!');

    }

        
        // validasi nama kategori yang di masukkan jika namanya benar lalu mengecek ke database apakah sudah ada? jika belum maka valid
        /**
         * 
         * function ini adalah function pertama yang saya pakai, ini saya non aktifkan karena dia funsinya untuk menambahkan kategori baru, tapi jika kategori yang di tambahkan sudah pernah di hapus maka tidak bisa di tambahkan lagi. karena dia harus memvalidasi data kalo tidak ada baru bisa di tambahkan
        $request->validate([
            'nama_kategori' => 'required|unique:kategori_barangs,nama_kategori',
        ]);

        KategoriBarang::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect('/kategori-barang')->with('sukses', 'Data kategori barang berhasil ditambahkan!');
   

    */
    /**
     * Display the specified resource.
     */
    public function show(KategoriBarang $kategoriBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriBarang $kategoriBarang)
    {
        return view('kategori-barang.edit', compact('kategoriBarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriBarang $kategoriBarang)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori_barangs,nama_kategori,' . $kategoriBarang->id,
        ]);

        $kategoriBarang->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect('/kategori-barang')->with('sukses', 'Data kategori barang berhasil diubah!');

    }

    //ini adalah kode untuk mengupdate ketagori barang, tapi saya sengaja mengahpusnya karena dia jika menambahkan barang yang sudah pernah di hapus maka tidak bisa. karena dia harus memvalidasi data kalo tidak ada baru bisa di tambahkan
    /** 
    
    */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriBarang $kategoriBarang)
    {
        $kategoriBarang->delete();

        return redirect('/kategori-barang')->with('sukses', 'Data kategori barang berhasil dihapus!');
    }
}
