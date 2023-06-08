<?php

namespace App\Http\Controllers;

use App\Models\TblBayar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BacaBayar extends Controller
{
    public function show_bayar()
    {
        $bayar = TblBayar::all();

        $data = [];
        foreach ($bayar as $item) {
            array_push($data, [
                'nama_barang' => $item->nama_barang,
                'email' => $item->email,
                'grandtotal' => $item->grandtotal,
                'harga_satuan' => $item->harga_satuan,
            ]);
        }

        return response()->json($data, 200);
    }
}
