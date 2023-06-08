<?php

namespace App\Http\Controllers;

use App\Models\Myproduct;

class Cariproduct extends Controller
{
    public function getProductById($id)
    {
        $product = Myproduct::where('idproducts', $id)->first();

        if ($product) {
            // Jika data ditemukan, lakukan sesuatu, misalnya tampilkan atau kembalikan respons JSON
            return response()->json($product);
        } else {
            // Jika data tidak ditemukan, berikan respons dengan kode status 404 (Not Found)
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
}
