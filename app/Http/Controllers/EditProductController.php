<?php
namespace App\Http\Controllers;

use App\Models\Myproduct;
use Illuminate\Http\Request;

class EditProductController extends Controller
{
    public function edit($id)
    {
        $product = Myproduct::where('idproducts', $id)->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return view('edit-product', ['product' => $product]);
    }

    public function update(Request $request, $id)
{
    $product = Myproduct::where('idproducts', $id)->first();

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $product->fill($request->all()); // Mengisi semua kolom dengan data dari request

    $product->save();

    return response()->json(['message' => 'Product updated successfully', 'data' => $product]);
}

}
