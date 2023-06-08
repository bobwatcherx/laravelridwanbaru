<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblBayarTable extends Migration
{
    public function up()
    {
        Schema::create('tblbayar', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('email');
            $table->decimal('grandtotal', 8, 2);
            $table->decimal('harga_satuan', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tblbayar');
    }
}

