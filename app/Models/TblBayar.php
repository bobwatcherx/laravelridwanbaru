<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblBayar extends Model
{
    use HasFactory;

    protected $table = 'tblbayar';

    protected $fillable = ['nama_barang', 'email', 'grandtotal', 'harga_satuan'];
}
