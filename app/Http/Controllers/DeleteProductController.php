<?php

namespace App\Http\Controllers;

use App\Models\Myproduct;
use Illuminate\Http\Request;

class DeleteProductController extends Controller
{
    public function destroy($idproduct)
    {
        $product = Myproduct::where('idproducts', $idproduct)->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
