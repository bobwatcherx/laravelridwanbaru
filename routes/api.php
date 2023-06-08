<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\Admincontroller; 
use App\Http\Controllers\ProductsController; 
use App\Http\Controllers\Bayar;
use App\Http\Controllers\BacaBayar;
use App\Http\Controllers\DeleteProductController;
use App\Http\Controllers\EditProductController;

use App\Http\Controllers\Cariproduct;

use App\Http\Controllers\BuatProductController;

Route::post('/create/product', [BuatProductController::class, 'create']);

Route::get('/search/products/{id}', [Cariproduct::class, 'getProductById']);

// Route untuk halaman edit produk
Route::get('/products/{id}/edit', [EditProductController::class, 'edit']);
Route::put('/products/{id}', [EditProductController::class, 'update']);


// Menghapus produk berdasarkan ID
Route::delete('/delete/products/{id}', [DeleteProductController::class, 'destroy']);




Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

Route::middleware(['admin.api'])->prefix('admin')->group(function(){
    Route::post('register',[AdminController::class,'register']);
    Route::get('register',[AdminController::class,'show_register']);
    Route::get('register/{id}',[AdminController::class,'show_register_by_id']);
    Route::put('register/{id}',[AdminController::class,'update_register']);
    Route::delete('register/{id}',[AdminController::class,'delete_register']);
    
    //product
    Route::post('products',[AdminController::class,'create_products']);
    Route::post('products/{id}',[AdminController::class,'update_products']);
    Route::delete('delete-products/{id}',[AdminController::class,'delete_products']);

    Route::get('publish-products/{id}',[AdminController::class,'publish_products']);
    Route::get('products/{id}',[AdminController::class,'unpublish_products']);
    
});
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::get('products',[ProductsController::class,'show_products']);
    

Route::post('bayar', [Bayar::class, 'store']);
Route::get('historybayar', [BacaBayar::class, 'show_bayar']);
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
