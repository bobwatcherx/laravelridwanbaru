<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateNewProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'author',
        'gambar',
        'sinopsis',
        'products_type',
        'products_price',
        'status_products',
        'user_email',
        'idproducts',
    ];

    protected $table = 'products'; // Nama tabel di database
    protected $primaryKey = 'idproducts';
}
