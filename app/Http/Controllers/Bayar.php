<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblBayar;

class Bayar extends Controller
{
    public function store(Request $request)
    {
        // Validasi inputan
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'email' => 'required|email',
            'grandtotal' => 'required|numeric',
            'harga_satuan' => 'required|numeric',
        ]);

        // Simpan data ke dalam tabel tblbayar menggunakan model
        $bayar = TblBayar::create([
            'nama_barang' => $request->nama_barang,
            'email' => $request->email,
            'grandtotal' => $request->grandtotal,
            'harga_satuan' => $request->harga_satuan,
        ]);

        // Berikan respon sukses
        return response()->json(['message' => 'Data berhasil disimpan'], 201);
    }
}
