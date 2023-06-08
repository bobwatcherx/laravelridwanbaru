<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'author',
        'gambar',
        'sinopsis',
        'products_type',
        'products_price',
        'status_products',
        'user_email'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_email','email');
    }
}


