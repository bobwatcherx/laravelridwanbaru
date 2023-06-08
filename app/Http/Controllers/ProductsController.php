<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    public function show_products()
    {
        $products = Products::with('user')->where('status_products', 'tersedia')->get();

        $data = [];
        foreach ($products as $product) {
            // Menambahkan pengecekan untuk memastikan objek user tidak null
            if ($product->user) {
                array_push($data, [
                    'idproducts' => $product->idproducts,
                    'judul' => $product->judul,
                    'gambar' => url($product->gambar),
                    'name' => $product->author,
                    'harga' => $product->products_price,
                    'tersedia' => $product->status_products,

                ]);
            }
        }

        return response()->json($data, 200);
    }
}
