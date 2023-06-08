<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Myproduct;
use Illuminate\Support\Str;

class BuatProductController extends Controller
{
    public function create(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'judul' => 'required|string',
            'author' => 'required|string',
            'gambar' => 'required|string',
            'sinopsis' => 'required|string',
            'products_type' => 'required|string',
            'products_price' => 'required|numeric',
            'status_products' => 'required|string',
            'user_email' => 'required|email',
            // 'idproducts' => 'required|string',
        ]);

        // Buat instance model Myproduct
        $myproduct = new Myproduct;
        $myproduct->judul = $request->input('judul');
        $myproduct->author = $request->input('author');
        $myproduct->gambar = $request->input('gambar');
        $myproduct->sinopsis = $request->input('sinopsis');
        $myproduct->products_type = $request->input('products_type');
        $myproduct->products_price = (float) $request->input('products_price'); // Tipe casting ke float
        $myproduct->status_products = $request->input('status_products');
        $myproduct->user_email = $request->input('user_email');
        // $myproduct->idproducts = (int) $request->input('idproducts'); // Tipe casting ke int

        // Simpan data ke database
        $myproduct->save();

        // Mengembalikan response sukses dengan status 201 Created
        return response()->json(['message' => 'Data added successfully'], 201);
    }
}
