<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_rating', function (Blueprint $table) {
            $table->id('idrating');
            $table->integer('rating');
            $table->string('review')->nullable();
            $table->unsignedBigInteger('products_idproducts');
            $table->foreign('products_idproducts')->references('idproducts')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->string('email_user');
            $table->foreign('email_user')->references('email')->on('user')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('products_rating');
    }
}
