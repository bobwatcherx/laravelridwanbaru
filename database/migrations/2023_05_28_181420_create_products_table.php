<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('idproducts');
            $table->string('judul');
            $table->string('gambar');
            $table->text('sinopsis');
            $table->enum('products_type',['fiksi','nyata']);
            $table->integer('products_price');
            $table->enum('status_products',['tersedia','habis']);
            $table->string('user_email');
            $table->string('author');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
