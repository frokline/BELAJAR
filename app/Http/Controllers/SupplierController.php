<?php

namespace App\Http\Controllers;

use App\Models\Supplier; //memanggil robot model suppplier
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //menyuruh model mengambil semua data supplier dari database
        $semuaSupplier = Supplier::all();

        //mengirim data tersebut ke file tampilan bernama 'supplier/supplier-index'
        return view('supplier.supplier-index', compact('semuaSupplier'));
    }

    //fungsi baru untuk memproses penyimpanan data 
    public function store(Request $request)
    { 
        //validasai agar data yang di masullan wajib di isi dan sesuai aturan
        $request->validate([
            'nama_supplier' => 'required',
            'no_hp' => 'required|max:15',
            'alamat' => 'required',
        ]);

         //menyuruh robot modedl memasukkan data formulir ke database
        Supplier::create([
            'nama_supplier' => $request->nama_supplier,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
        ]);

    //mengembalikan halaman ke daftar supplier dengan membawa pesan sukses
    return redirect('/supplier')->with('sukses', 'data supplier berhasil di tambahkan!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.supplier-create');
    }


    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.supplier-edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama_supplier' => 'required',
            'no_hp' => 'required|max:15',
            'alamat' => 'required',
        ]);

        $supplier->update([
            'nama_supplier' => $request->nama_supplier,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
        ]);

        return redirect('/supplier')->with('sukses', 'Data supplier berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect('/supplier')->with('sukses', 'Data supplier berhasil dihapus!');
    }
}
